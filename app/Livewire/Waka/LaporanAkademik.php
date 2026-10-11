<?php

namespace App\Livewire\Waka;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\NilaiFormatif;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Symfony\Component\HttpFoundation\StreamedResponse;

#[Layout('layouts.app')]
class LaporanAkademik extends Component
{
    public string $selectedTingkat = 'Semua';
    public string $selectedKelasId = 'Semua';
    public string $selectedMapelId = 'Semua';
    public string $selectedSemester = 'Ganjil';

    public function mount(): void
    {
        abort_unless(auth()->user()->hasAnyRole(['admin_tu', 'waka_kurikulum']), 403);
    }

    public function exportCsv(): StreamedResponse
    {
        abort_unless(auth()->user()->hasAnyRole(['admin_tu', 'waka_kurikulum']), 403);

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="laporan-akademik-man4jombang-' . date('Y-m-d') . '.csv"',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOM

            fputcsv($handle, ['LAPORAN ANALITIK AKADEMIK & PRESENSI MAN 4 JOMBANG']);
            fputcsv($handle, ['Tanggal Export', date('d-m-Y H:i:s')]);
            fputcsv($handle, ['Semester', $this->selectedSemester]);
            fputcsv($handle, []);

            fputcsv($handle, ['No', 'Kelas', 'Tingkat', 'Total Siswa', 'Rata-rata Presensi (%)', 'Rata-rata Nilai Formatif', 'Ketuntasan KKM (%)']);

            $kelases = Kelas::withCount('siswa as siswa_count')
                ->when($this->selectedTingkat !== 'Semua', fn($q) => $q->where('tingkat', $this->selectedTingkat))
                ->when($this->selectedKelasId !== 'Semua', fn($q) => $q->where('id', $this->selectedKelasId))
                ->orderBy('tingkat')
                ->orderBy('nama_kelas')
                ->get();

            $kelasIds = $kelases->pluck('id');

            // Constant query: Aggregate attendance per class
            $absensiStats = Absensi::join('siswa', 'absensi.siswa_id', '=', 'siswa.id')
                ->whereIn('siswa.kelas_id', $kelasIds)
                ->select(
                    'siswa.kelas_id',
                    DB::raw('COUNT(*) as total_absensi'),
                    DB::raw("SUM(CASE WHEN absensi.status = 'hadir' THEN 1 ELSE 0 END) as total_hadir")
                )
                ->groupBy('siswa.kelas_id')
                ->get()
                ->keyBy('kelas_id');

            // Constant query: Aggregate formatif grades per class
            $nilaiStats = NilaiFormatif::join('siswa', 'nilai_formatif.siswa_id', '=', 'siswa.id')
                ->whereIn('siswa.kelas_id', $kelasIds)
                ->when($this->selectedMapelId !== 'Semua', fn($q) => $q->where('nilai_formatif.mapel_id', $this->selectedMapelId))
                ->select(
                    'siswa.kelas_id',
                    DB::raw('COUNT(*) as total_nilai'),
                    DB::raw('AVG(nilai_formatif.nilai) as avg_nilai'),
                    DB::raw('SUM(CASE WHEN nilai_formatif.nilai >= 75 THEN 1 ELSE 0 END) as total_tuntas')
                )
                ->groupBy('siswa.kelas_id')
                ->get()
                ->keyBy('kelas_id');

            $no = 1;
            foreach ($kelases as $kls) {
                $absensi = $absensiStats->get($kls->id);
                $totalAbsensi = $absensi ? (int) $absensi->total_absensi : 0;
                $totalHadir = $absensi ? (int) $absensi->total_hadir : 0;
                $persenHadirStr = $totalAbsensi > 0 ? round(($totalHadir / $totalAbsensi) * 100, 1) . '%' : '-';

                $nilai = $nilaiStats->get($kls->id);
                $totalNilai = $nilai ? (int) $nilai->total_nilai : 0;
                $rerataNilai = ($nilai && $nilai->avg_nilai !== null) ? round((float) $nilai->avg_nilai, 1) : '-';
                $tuntasCount = $nilai ? (int) $nilai->total_tuntas : 0;
                $persenTuntasStr = $totalNilai > 0 ? round(($tuntasCount / $totalNilai) * 100, 1) . '%' : '-';

                fputcsv($handle, [
                    $no++,
                    $kls->nama_kelas,
                    $kls->tingkat,
                    $kls->siswa_count,
                    $persenHadirStr,
                    $rerataNilai,
                    $persenTuntasStr,
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }

    public function render()
    {
        $totalSiswa = Siswa::count();
        $totalKelas = Kelas::count();
        $totalMapel = Mapel::count();

        // Query classes with filters
        $kelases = Kelas::withCount('siswa as siswa_count')
            ->when($this->selectedTingkat !== 'Semua', fn($q) => $q->where('tingkat', $this->selectedTingkat))
            ->when($this->selectedKelasId !== 'Semua', fn($q) => $q->where('id', $this->selectedKelasId))
            ->orderBy('tingkat')
            ->orderBy('nama_kelas')
            ->get();

        $kelasIds = $kelases->pluck('id');

        // Constant query: Aggregate attendance per class
        $absensiStats = Absensi::join('siswa', 'absensi.siswa_id', '=', 'siswa.id')
            ->whereIn('siswa.kelas_id', $kelasIds)
            ->select(
                'siswa.kelas_id',
                DB::raw('COUNT(*) as total_absensi'),
                DB::raw("SUM(CASE WHEN absensi.status = 'hadir' THEN 1 ELSE 0 END) as hadir_count"),
                DB::raw("SUM(CASE WHEN absensi.status = 'izin' THEN 1 ELSE 0 END) as izin_count"),
                DB::raw("SUM(CASE WHEN absensi.status = 'sakit' THEN 1 ELSE 0 END) as sakit_count"),
                DB::raw("SUM(CASE WHEN absensi.status = 'alfa' THEN 1 ELSE 0 END) as alfa_count")
            )
            ->groupBy('siswa.kelas_id')
            ->get()
            ->keyBy('kelas_id');

        // Constant query: Aggregate formatif grades per class
        $nilaiStats = NilaiFormatif::join('siswa', 'nilai_formatif.siswa_id', '=', 'siswa.id')
            ->whereIn('siswa.kelas_id', $kelasIds)
            ->when($this->selectedMapelId !== 'Semua', fn($q) => $q->where('nilai_formatif.mapel_id', $this->selectedMapelId))
            ->select(
                'siswa.kelas_id',
                DB::raw('COUNT(*) as total_nilai'),
                DB::raw('AVG(nilai_formatif.nilai) as avg_nilai')
            )
            ->groupBy('siswa.kelas_id')
            ->get()
            ->keyBy('kelas_id');

        $classReports = [];
        $grandTotalHadir = 0;
        $grandTotalAbsensi = 0;
        $validAvgGrades = [];

        foreach ($kelases as $kls) {
            $abs = $absensiStats->get($kls->id);
            $hadir = $abs ? (int) $abs->hadir_count : 0;
            $izin = $abs ? (int) $abs->izin_count : 0;
            $sakit = $abs ? (int) $abs->sakit_count : 0;
            $alfa = $abs ? (int) $abs->alfa_count : 0;
            $totAbsen = $hadir + $izin + $sakit + $alfa;

            $grandTotalHadir += $hadir;
            $grandTotalAbsensi += $totAbsen;

            $rateHadir = $totAbsen > 0 ? round(($hadir / $totAbsen) * 100, 1) : null;

            $nil = $nilaiStats->get($kls->id);
            $formattedAvg = ($nil && $nil->avg_nilai !== null) ? round((float) $nil->avg_nilai, 1) : null;

            if ($formattedAvg !== null) {
                $validAvgGrades[] = $formattedAvg;
                $statusKetuntasan = $formattedAvg >= 75 ? 'Tuntas' : 'Perlu Remedial';
            } else {
                $statusKetuntasan = 'Belum Ada Data';
            }

            $classReports[] = [
                'id' => $kls->id,
                'nama_kelas' => $kls->nama_kelas,
                'tingkat' => $kls->tingkat,
                'siswa_count' => $kls->siswa_count,
                'hadir_count' => $hadir,
                'absen_count' => $totAbsen,
                'rate_hadir' => $rateHadir,
                'avg_nilai' => $formattedAvg,
                'status_ketuntasan' => $statusKetuntasan,
            ];
        }

        $overallAttendanceRate = $grandTotalAbsensi > 0 ? round(($grandTotalHadir / $grandTotalAbsensi) * 100, 1) : null;
        $overallAvgGrade = count($validAvgGrades) > 0 ? round(array_sum($validAvgGrades) / count($validAvgGrades), 1) : null;

        $mapels = Mapel::orderBy('nama_mapel')->get();
        $allKelasOptions = Kelas::orderBy('nama_kelas')->get();

        return view('livewire.waka.laporan-akademik', [
            'totalSiswa' => $totalSiswa,
            'totalKelas' => $totalKelas,
            'totalMapel' => $totalMapel,
            'classReports' => $classReports,
            'overallAttendanceRate' => $overallAttendanceRate,
            'overallAvgGrade' => $overallAvgGrade,
            'mapels' => $mapels,
            'allKelasOptions' => $allKelasOptions,
        ]);
    }
}
