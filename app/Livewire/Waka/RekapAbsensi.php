<?php

namespace App\Livewire\Waka;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RekapAbsensi extends Component
{
    use WithPagination;

    public $selectedKelas = '';
    public $startDate = '';
    public $endDate = '';
    public $search = '';

    public function mount()
    {
        $this->startDate = date('Y-m-01'); // start of current month
        $this->endDate = date('Y-m-d');
    }

    public function updatingSelectedKelas()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Base query for fetching filtered students.
     */
    private function getBaseSiswaQuery(): Builder
    {
        return Siswa::with('kelas')
            ->when(!empty($this->selectedKelas), fn($q) => $q->where('kelas_id', $this->selectedKelas))
            ->when(!empty($this->search), function($q) {
                $q->where(function($sub) {
                    $sub->where('nama', 'like', '%' . $this->search . '%')
                        ->orWhere('nisn', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('nama');
    }

    /**
     * Compute aggregated attendance statistics for the given collection of students.
     * Single aggregated query eliminates N+1 queries.
     */
    private function getRekapDataForSiswas($siswas): array
    {
        $siswaIds = collect($siswas)->pluck('id');

        $absensiCounts = Absensi::whereIn('siswa_id', $siswaIds)
            ->when(!empty($this->startDate), fn($q) => $q->where('tanggal', '>=', $this->startDate))
            ->when(!empty($this->endDate), fn($q) => $q->where('tanggal', '<=', $this->endDate))
            ->select('siswa_id', 'status', DB::raw('count(*) as total'))
            ->groupBy('siswa_id', 'status')
            ->get()
            ->groupBy('siswa_id');

        $rekapData = [];
        foreach ($siswas as $siswa) {
            $records = $absensiCounts->get($siswa->id, collect());
            $hadir = (int) ($records->firstWhere('status', 'hadir')->total ?? 0);
            $izin  = (int) ($records->firstWhere('status', 'izin')->total ?? 0);
            $sakit = (int) ($records->firstWhere('status', 'sakit')->total ?? 0);
            $alfa  = (int) ($records->firstWhere('status', 'alfa')->total ?? 0);
            $total = $hadir + $izin + $sakit + $alfa;

            $persentase = $total > 0 ? round(($hadir / $total) * 100, 1) : 0;

            $rekapData[$siswa->id] = [
                'hadir' => $hadir,
                'izin' => $izin,
                'sakit' => $sakit,
                'alfa' => $alfa,
                'total' => $total,
                'persentase' => $persentase,
            ];
        }

        return $rekapData;
    }

    public function exportCsv(): StreamedResponse
    {
        $siswas = $this->getBaseSiswaQuery()->get();
        $rekapData = $this->getRekapDataForSiswas($siswas);
        $fileName = 'rekap-absensi-' . date('Ymd-His') . '.csv';

        return response()->streamDownload(function () use ($siswas, $rekapData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['NISN', 'Nama Siswa', 'Kelas', 'Hadir', 'Izin', 'Sakit', 'Alfa', 'Total JP', 'Persentase Kehadiran (%)']);

            foreach ($siswas as $siswa) {
                $stat = $rekapData[$siswa->id] ?? [
                    'hadir' => 0,
                    'izin' => 0,
                    'sakit' => 0,
                    'alfa' => 0,
                    'total' => 0,
                    'persentase' => 0,
                ];

                fputcsv($handle, [
                    $siswa->nisn,
                    $siswa->nama,
                    $siswa->kelas?->nama_kelas ?? '-',
                    $stat['hadir'],
                    $stat['izin'],
                    $stat['sakit'],
                    $stat['alfa'],
                    $stat['total'],
                    $stat['persentase'] . '%',
                ]);
            }

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ]);
    }

    public function render()
    {
        $kelases = Kelas::orderBy('nama_kelas')->get();
        $siswas = $this->getBaseSiswaQuery()->paginate(15);
        $rekapData = $this->getRekapDataForSiswas($siswas->items());

        return view('livewire.waka.rekap-absensi', [
            'siswas' => $siswas,
            'rekapData' => $rekapData,
            'kelases' => $kelases,
        ])->layout('layouts.app', ['header' => 'Rekapitulasi Absensi']);
    }
}
