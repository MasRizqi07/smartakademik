<?php

namespace App\Livewire\Waka;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
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

        // Fetch absensi statistics for these students
        $rekapData = [];
        foreach ($siswas as $siswa) {
            $absensiQuery = Absensi::where('siswa_id', $siswa->id);

            if (!empty($this->startDate)) {
                $absensiQuery->where('tanggal', '>=', $this->startDate);
            }
            if (!empty($this->endDate)) {
                $absensiQuery->where('tanggal', '<=', $this->endDate);
            }

            $records = $absensiQuery->get();

            $hadir = $records->where('status', 'hadir')->count();
            $izin  = $records->where('status', 'izin')->count();
            $sakit = $records->where('status', 'sakit')->count();
            $alfa  = $records->where('status', 'alfa')->count();
            $total = $records->count();

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
