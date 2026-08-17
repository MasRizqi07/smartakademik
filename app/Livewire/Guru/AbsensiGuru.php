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
        foreach ($this->siswas as $siswa) {
            $this->absensiData[$siswa->id] = 'hadir';
        }
        session()->flash('message', 'Semua siswa berhasil ditandai HADIR.');
    }

    public function loadSiswas()
    {
        if (!$this->selectedJadwalId || !$this->tanggal) {
            $this->siswas = [];
            $this->absensiData = [];
            return;
        }

        $jadwal = JadwalPelajaran::findOrFail($this->selectedJadwalId);

        // Authorize check
        if (auth()->user()->hasRole('guru')) {
            $this->authorize('create', [Absensi::class, $jadwal]);
        }

        $this->siswas = Siswa::where('kelas_id', $jadwal->kelas_id)->orderBy('nama')->get();

        // Load existing absensi for this date and jadwal
        $existing = Absensi::where('jadwal_id', $this->selectedJadwalId)
            ->where('tanggal', $this->tanggal)
            ->get()
            ->keyBy('siswa_id');

        $this->absensiData = [];
        foreach ($this->siswas as $siswa) {
            if ($existing->has($siswa->id)) {
                $this->absensiData[$siswa->id] = $existing[$siswa->id]->status;
            } else {
                $this->absensiData[$siswa->id] = null;
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
                    'dicatat_oleh' => auth()->id(),
                ]
            );
        }

        session()->flash('message', 'Presensi kelas berhasil disimpan dengan sukses!');
    }

    public function render()
    {
        return view('livewire.guru.absensi-guru')->layout('layouts.app', ['header' => 'Input Presensi Kelas']);
    }
}
