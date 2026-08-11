<?php

namespace App\Livewire\Guru;

use App\Models\Absensi;
use App\Models\JadwalPelajaran;
use App\Models\Siswa;
use Livewire\Component;

class AbsensiGuru extends Component
{
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

        $jadwal = JadwalPelajaran::find($this->selectedJadwalId);
        if (!$jadwal) {
            return;
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
                // Default 'hadir'
                $this->absensiData[$siswa->id] = 'hadir';
            }
        }
    }

    public function save()
    {
        if (!$this->selectedJadwalId || !$this->tanggal) {
            return;
        }

        foreach ($this->siswas as $siswa) {
            $status = $this->absensiData[$siswa->id] ?? 'hadir';
            
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
