<?php

namespace App\Livewire\Waka;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

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

    public function render()
    {
        $kelases = Kelas::orderBy('nama_kelas')->get();

        $siswaQuery = Siswa::with('kelas');

        if (!empty($this->selectedKelas)) {
            $siswaQuery->where('kelas_id', $this->selectedKelas);
        }

        if (!empty($this->search)) {
            $siswaQuery->where(function($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('nisn', 'like', '%' . $this->search . '%');
            });
        }

        $siswas = $siswaQuery->orderBy('nama')->paginate(15);

        // Fetch absensi statistics for these students in a single aggregated query (eliminates N+1)
        $siswaIds = $siswas->pluck('id');

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

        return view('livewire.waka.rekap-absensi', [
            'siswas' => $siswas,
            'rekapData' => $rekapData,
            'kelases' => $kelases,
        ])->layout('layouts.app', ['header' => 'Rekapitulasi Absensi']);
    }
}
