<?php

namespace App\Livewire\Siswa;

use App\Models\Absensi;
use App\Models\JadwalPelajaran;
use App\Models\NilaiFormatif;
use Livewire\Component;

class SiswaDashboard extends Component
{
    public $activeTab = 'jadwal'; // jadwal, absensi, nilai

    public function render()
    {
        $siswa = auth()->user()->siswa;
        
        $jadwals = [];
        $absensis = [];
        $nilais = [];

        if ($siswa) {
            if ($this->activeTab === 'jadwal') {
                $jadwals = JadwalPelajaran::with(['mapel', 'guru'])
                    ->where('kelas_id', $siswa->kelas_id)
                    ->orderBy('hari')
                    ->orderBy('jam_ke')
                    ->get()
                    ->groupBy('hari');
            } elseif ($this->activeTab === 'absensi') {
                $absensis = Absensi::with(['jadwal.mapel', 'dicatatOleh'])
                    ->where('siswa_id', $siswa->id)
                    ->orderBy('tanggal', 'desc')
                    ->get();
            } elseif ($this->activeTab === 'nilai') {
                $nilais = NilaiFormatif::with(['mapel', 'guru'])
                    ->where('siswa_id', $siswa->id)
                    ->orderBy('tanggal', 'desc')
                    ->get();
            }
        }

        return view('livewire.siswa.siswa-dashboard', [
            'siswa' => $siswa,
            'jadwals' => $jadwals,
            'absensis' => $absensis,
            'nilais' => $nilais,
        ])->layout('layouts.app', ['header' => 'Dashboard Siswa']);
    }
}
