<?php

namespace App\Livewire\Guru;

use App\Models\Absensi;
use App\Models\JadwalPelajaran;
use App\Models\Siswa;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class AbsensiGuru extends Component
{
    use AuthorizesRequests;

    public $jadwals = [];
    public $selectedJadwalId = null;
    public $siswas = [];
    public $tanggal = '';
    
    // absensiData: [siswa_id => status]
    public $absensiData = [];
    public $keteranganData = [];

    // Note Modal
    public $activeSiswaId = null;
    public $activeSiswaName = '';
    public $noteText = '';
    public $isNoteModalOpen = false;

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->loadJadwals();
    }

    public function loadJadwals()
    {
        $guru = auth()->user()->guru;
        if (!$guru) {
            $this->jadwals = JadwalPelajaran::with(['kelas', 'mapel'])->orderBy('jam_ke')->get();
            if ($this->jadwals->isNotEmpty() && !$this->selectedJadwalId) {
                $this->selectedJadwalId = $this->jadwals->first()->id;
                $this->loadSiswas();
            }
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

    public function updatedTanggal()
    {
        $this->loadSiswas();
    }

    public function markAllHadir()
    {
        if (!$this->selectedJadwalId || !$this->tanggal) return;

        foreach ($this->siswas as $siswa) {
            $this->absensiData[$siswa->id] = 'hadir';
            
            Absensi::updateOrCreate(
                [
                    'siswa_id' => $siswa->id,
                    'jadwal_id' => $this->selectedJadwalId,
                    'tanggal' => $this->tanggal,
                ],
                [
                    'status' => 'hadir',
                    'dicatat_oleh' => auth()->id(),
                ]
            );
        }
        session()->flash('message', 'Semua siswa berhasil ditandai HADIR dan tersimpan otomatis.');
    }

    public function resetAll()
    {
        if (!$this->selectedJadwalId || !$this->tanggal) return;

        Absensi::where('jadwal_id', $this->selectedJadwalId)
            ->where('tanggal', $this->tanggal)
            ->delete();

        foreach ($this->siswas as $siswa) {
            $this->absensiData[$siswa->id] = null;
        }
        session()->flash('message', 'Status presensi kelas berhasil direset.');
    }

    public function setPresence($siswaId, $status)
    {
        $this->absensiData[$siswaId] = $status;

        if ($this->selectedJadwalId && $this->tanggal) {
            Absensi::updateOrCreate(
                [
                    'siswa_id' => $siswaId,
                    'jadwal_id' => $this->selectedJadwalId,
                    'tanggal' => $this->tanggal,
                ],
                [
                    'status' => $status,
                    'keterangan' => $this->keteranganData[$siswaId] ?? null,
                    'dicatat_oleh' => auth()->id(),
                ]
            );
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
        if ($this->activeSiswaId) {
            $this->keteranganData[$this->activeSiswaId] = $this->noteText;

            if ($this->selectedJadwalId && $this->tanggal && !empty($this->absensiData[$this->activeSiswaId])) {
                Absensi::where('siswa_id', $this->activeSiswaId)
                    ->where('jadwal_id', $this->selectedJadwalId)
                    ->where('tanggal', $this->tanggal)
                    ->update(['keterangan' => $this->noteText]);
            }
        }
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

        if (auth()->user()->hasRole('guru')) {
            $this->authorize('create', [Absensi::class, $jadwal]);
        }

        $this->siswas = Siswa::where('kelas_id', $jadwal->kelas_id)->orderBy('nama')->get();

        $existing = Absensi::where('jadwal_id', $this->selectedJadwalId)
            ->where('tanggal', $this->tanggal)
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
        if (!$this->selectedJadwalId || !$this->tanggal) {
            return;
        }

        $jadwal = JadwalPelajaran::findOrFail($this->selectedJadwalId);

        if (auth()->user()->hasRole('guru')) {
            $this->authorize('create', [Absensi::class, $jadwal]);
        }

        foreach ($this->siswas as $siswa) {
            if (empty($this->absensiData[$siswa->id])) {
                session()->flash('error', 'Semua siswa wajib ditandai status kehadirannya sebelum menyimpan!');
                return;
            }
        }

        foreach ($this->siswas as $siswa) {
            $status = $this->absensiData[$siswa->id];
            
            Absensi::updateOrCreate(
                [
                    'siswa_id' => $siswa->id,
                    'jadwal_id' => $this->selectedJadwalId,
                    'tanggal' => $this->tanggal,
                ],
                [
                    'status' => $status,
                    'keterangan' => $this->keteranganData[$siswa->id] ?? null,
                    'dicatat_oleh' => auth()->id(),
                ]
            );
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
