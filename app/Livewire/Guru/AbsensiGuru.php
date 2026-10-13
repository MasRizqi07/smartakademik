<?php

namespace App\Livewire\Guru;

use App\Models\Absensi;
use App\Models\JadwalPelajaran;
use App\Models\Siswa;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Locked;
use Livewire\Component;

class AbsensiGuru extends Component
{
    use AuthorizesRequests;

    private const STATUSES = ['hadir', 'izin', 'sakit', 'alfa'];

    public $jadwals = [];
    public $selectedJadwalId = null;
    public $siswas = [];

    #[Locked]
    public $tanggal = '';
    
    // absensiData: [siswa_id => status]
    public $absensiData = [];
    public $keteranganData = [];

    // Note Modal
    public $activeSiswaId = null;
    public $activeSiswaName = '';
    public $noteText = '';
    public $isNoteModalOpen = false;

    private function jadwalOrFail(): JadwalPelajaran
    {
        abort_unless($this->selectedJadwalId && $this->tanggal, 422);
        abort_unless($this->tanggal === today()->toDateString(), 422, 'Tanggal presensi hanya boleh hari ini. Muat ulang halaman.');
        $jadwal = JadwalPelajaran::findOrFail($this->selectedJadwalId);
        $this->authorize('create', [Absensi::class, $jadwal]);   // unconditional
        return $jadwal;
    }

    private function siswaInKelasOrFail(JadwalPelajaran $jadwal, $siswaId): Siswa
    {
        $siswa = Siswa::where('id', $siswaId)->where('kelas_id', $jadwal->kelas_id)->first();
        abort_unless($siswa, 404);
        return $siswa;
    }

    public function mount($selectedJadwalId = null)
    {
        $this->tanggal = today()->toDateString();
        if ($selectedJadwalId) {
            $this->selectedJadwalId = $selectedJadwalId;
        } else {
            $this->loadJadwals();
        }
    }

    public function loadJadwals()
    {
        $guru = auth()->user()->guru;
        if (!$guru) {
            $this->jadwals = collect();
            return;
        }

        $this->jadwals = JadwalPelajaran::with(['kelas', 'mapel'])
            ->where('guru_id', $guru->id)
            ->orderBy('jam_ke')
            ->get();
            
        if ($this->jadwals->isNotEmpty() && !$this->selectedJadwalId) {
            $this->selectedJadwalId = $this->jadwals->first()->id;
            $this->loadSiswas();
        }
    }

    public function updatedSelectedJadwalId()
    {
        $this->loadSiswas();
    }

    public function markAllHadir(): void
    {
        $this->jadwalOrFail();
        $filled = 0;
        foreach ($this->siswas as $siswa) {
            if (empty($this->absensiData[$siswa->id])) {
                $this->absensiData[$siswa->id] = 'hadir';
                $filled++;
            }
        }
        session()->flash('message', "$filled siswa yang belum ditandai diset Hadir (belum tersimpan). Periksa, lalu tekan Simpan.");
    }

    public function resetAll()
    {
        $jadwal = $this->jadwalOrFail();

        Absensi::where('jadwal_id', $jadwal->id)
            ->whereDate('tanggal', $this->tanggal)
            ->delete();

        foreach ($this->siswas as $siswa) {
            $this->absensiData[$siswa->id] = null;
        }
        session()->flash('message', 'Status presensi kelas berhasil direset.');
    }

    public function setPresence($siswaId, $status)
    {
        abort_unless(in_array($status, self::STATUSES, true), 422);
        $jadwal = $this->jadwalOrFail();
        $this->siswaInKelasOrFail($jadwal, $siswaId);

        $this->absensiData[$siswaId] = $status;

        $record = Absensi::where('siswa_id', $siswaId)
            ->where('jadwal_id', $jadwal->id)
            ->whereDate('tanggal', $this->tanggal)
            ->first();

        if ($record) {
            $record->update([
                'status' => $status,
                'keterangan' => $this->keteranganData[$siswaId] ?? null,
                'dicatat_oleh' => auth()->id(),
            ]);
        } else {
            Absensi::create([
                'siswa_id' => $siswaId,
                'jadwal_id' => $jadwal->id,
                'tanggal' => $this->tanggal,
                'status' => $status,
                'keterangan' => $this->keteranganData[$siswaId] ?? null,
                'dicatat_oleh' => auth()->id(),
            ]);
        }
    }

    public function openNoteModal($siswaId, $siswaName)
    {
        $this->activeSiswaId = $siswaId;
        $this->activeSiswaName = $siswaName;
        $this->noteText = $this->keteranganData[$siswaId] ?? '';
        $this->isNoteModalOpen = true;
    }

    public function saveNote()
    {
        abort_unless($this->activeSiswaId, 422);
        $jadwal = $this->jadwalOrFail();
        $this->siswaInKelasOrFail($jadwal, $this->activeSiswaId);
        $this->validate(['noteText' => 'nullable|string|max:255']);

        $this->keteranganData[$this->activeSiswaId] = $this->noteText;

        Absensi::where('siswa_id', $this->activeSiswaId)
            ->where('jadwal_id', $jadwal->id)
            ->whereDate('tanggal', $this->tanggal)
            ->update(['keterangan' => $this->noteText]);

        $this->isNoteModalOpen = false;
        session()->flash('message', 'Catatan siswa berhasil disimpan.');
    }

    public function loadSiswas()
    {
        if (!$this->selectedJadwalId || !$this->tanggal) {
            $this->siswas = [];
            $this->absensiData = [];
            $this->keteranganData = [];
            return;
        }

        $jadwal = JadwalPelajaran::findOrFail($this->selectedJadwalId);
        $this->authorize('create', [Absensi::class, $jadwal]);

        $this->siswas = Siswa::where('kelas_id', $jadwal->kelas_id)->orderBy('nama')->get();

        $existing = Absensi::where('jadwal_id', $this->selectedJadwalId)
            ->whereDate('tanggal', $this->tanggal)
            ->get()
            ->keyBy('siswa_id');

        $this->absensiData = [];
        $this->keteranganData = [];
        foreach ($this->siswas as $siswa) {
            if ($existing->has($siswa->id)) {
                $this->absensiData[$siswa->id] = $existing[$siswa->id]->status;
                $this->keteranganData[$siswa->id] = $existing[$siswa->id]->keterangan ?? '';
            } else {
                $this->absensiData[$siswa->id] = null;
                $this->keteranganData[$siswa->id] = '';
            }
        }
    }

    public function save()
    {
        $jadwal = $this->jadwalOrFail();

        $allSiswaIds = Siswa::where('kelas_id', $jadwal->kelas_id)->pluck('id');

        foreach ($allSiswaIds as $siswaId) {
            if (empty($this->absensiData[$siswaId])) {
                session()->flash('error', 'Semua siswa wajib ditandai status kehadirannya sebelum menyimpan!');
                return;
            }

            $status = $this->absensiData[$siswaId];
            abort_unless(in_array($status, self::STATUSES, true), 422, 'Status absensi tidak valid.');

            $keterangan = $this->keteranganData[$siswaId] ?? null;
            if ($keterangan !== null) {
                abort_unless(is_string($keterangan) && mb_strlen($keterangan) <= 255, 422, 'Keterangan tidak valid.');
            }
        }

        foreach ($allSiswaIds as $siswaId) {
            $status = $this->absensiData[$siswaId];
            
            $record = Absensi::where('siswa_id', $siswaId)
                ->where('jadwal_id', $jadwal->id)
                ->whereDate('tanggal', $this->tanggal)
                ->first();

            if ($record) {
                $record->update([
                    'status' => $status,
                    'keterangan' => $this->keteranganData[$siswaId] ?? null,
                    'dicatat_oleh' => auth()->id(),
                ]);
            } else {
                Absensi::create([
                    'siswa_id' => $siswaId,
                    'jadwal_id' => $jadwal->id,
                    'tanggal' => $this->tanggal,
                    'status' => $status,
                    'keterangan' => $this->keteranganData[$siswaId] ?? null,
                    'dicatat_oleh' => auth()->id(),
                ]);
            }
        }

        session()->flash('message', 'Seluruh data presensi kelas berhasil disimpan!');
    }

    public function render()
    {
        $hadirCount = collect($this->absensiData)->filter(fn($s) => $s === 'hadir')->count();
        $izinCount  = collect($this->absensiData)->filter(fn($s) => $s === 'izin')->count();
        $sakitCount = collect($this->absensiData)->filter(fn($s) => $s === 'sakit')->count();
        $alfaCount  = collect($this->absensiData)->filter(fn($s) => $s === 'alfa')->count();

        return view('livewire.guru.absensi-guru', [
            'hadirCount' => $hadirCount,
            'izinCount' => $izinCount,
            'sakitCount' => $sakitCount,
            'alfaCount' => $alfaCount,
            'totalSiswa' => count($this->siswas),
        ])->layout('layouts.app', ['header' => 'Input Presensi Kelas']);
    }
}
