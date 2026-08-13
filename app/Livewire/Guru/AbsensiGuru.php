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
        // Guru yang login
        $guru = auth()->user()->guru;
        if (!$guru) {
            return;
        }

        // Ambil jadwal hari ini untuk guru tersebut
        $this->jadwals = JadwalPelajaran::with(['kelas', 'mapel'])
            ->where('guru_id', $guru->id)
            ->hariIni() // using scopeHariIni
            ->orderBy('jam_ke')
            ->get();
    }

    public function updatedSelectedJadwalId()
    {
        $this->loadSiswas();
    }

    public function updatedTanggal()
    {
        $this->loadSiswas();
    }

    public function loadSiswas()
    {
        if (!$this->selectedJadwalId || !$this->tanggal) {
            $this->siswas = [];
            $this->absensiData = [];
            return;
        }

        $jadwal = JadwalPelajaran::findOrFail($this->selectedJadwalId);

        // K2: Authorize that the logged in user can input absensi for this schedule
        abort_unless($jadwal->guru && $jadwal->guru->user_id === auth()->id(), 403, 'Anda tidak memiliki akses ke jadwal kelas ini.');

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
                // M4: Default null (unselected) per design-system.md 5.2 to prevent default "hadir"
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

        // K2: Authorize check before save
        abort_unless($jadwal->guru && $jadwal->guru->user_id === auth()->id(), 403, 'Anda tidak memiliki akses ke jadwal kelas ini.');

        // M4: Check if any student attendance status is unselected
        foreach ($this->siswas as $siswa) {
            if (empty($this->absensiData[$siswa->id])) {
                session()->flash('error', 'Semua siswa wajib ditandai status kehadirannya!');
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

        session()->flash('message', 'Absensi berhasil disimpan!');
    }

    public function render()
    {
        return view('livewire.guru.absensi-guru')->layout('layouts.app', ['header' => 'Absensi Kelas']);
    }
}

