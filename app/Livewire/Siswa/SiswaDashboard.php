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

        $attendanceRate = '-';
        $avgGrade = '-';
        $gradeSubtext = 'Belum ada data';
        $totalMapelCount = 0;

        if ($siswa) {
            $absCount = Absensi::where('siswa_id', $siswa->id)
                ->selectRaw("COUNT(*) as total, SUM(CASE WHEN status = 'hadir' THEN 1 ELSE 0 END) as hadir")
                ->first();

            if ($absCount && $absCount->total > 0) {
                $attendanceRate = number_format(($absCount->hadir / $absCount->total) * 100, 1) . '%';
            }

            $kkm = (int) (\App\Models\PengaturanAkademik::value('kkm_default') ?? 75);
            $gradeStats = NilaiFormatif::where('siswa_id', $siswa->id)
                ->selectRaw("COUNT(*) as total, AVG(nilai) as avg_nilai")
                ->first();

            if ($gradeStats && $gradeStats->total > 0) {
                $val = round((float)$gradeStats->avg_nilai, 1);
                $avgGrade = (string)$val;
                $gradeSubtext = $val >= $kkm ? "Memenuhi KKM ({$kkm})" : "Di bawah KKM ({$kkm})";
            }

            $totalMapelCount = JadwalPelajaran::where('kelas_id', $siswa->kelas_id)->distinct('mapel_id')->count('mapel_id');
            if ($totalMapelCount === 0) {
                $totalMapelCount = \App\Models\Mapel::count();
            }

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
            'attendanceRate' => $attendanceRate,
            'avgGrade' => $avgGrade,
            'gradeSubtext' => $gradeSubtext,
            'totalMapelCount' => $totalMapelCount,
        ])->layout('layouts.app', ['header' => 'Dashboard Siswa']);
    }
}
