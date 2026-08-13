<?php

namespace App\Livewire\Waka;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\NilaiFormatif;
use App\Models\Siswa;
use Livewire\Component;
use Livewire\WithPagination;

class RekapNilai extends Component
{
    use WithPagination;

    public $selectedKelas = '';
    public $selectedMapel = '';
    public $selectedJenis = '';
    public $search = '';

    public function updatingSelectedKelas()
    {
        $this->resetPage();
    }

    public function updatingSelectedMapel()
    {
        $this->resetPage();
    }

    public function updatingSelectedJenis()
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
        $mapels = Mapel::orderBy('nama_mapel')->get();

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

        // Fetch grades for these students
        $rekapNilai = [];
        foreach ($siswas as $siswa) {
            $nilaiQuery = NilaiFormatif::where('siswa_id', $siswa->id);

            if (!empty($this->selectedMapel)) {
                $nilaiQuery->where('mapel_id', $this->selectedMapel);
            }

            if (!empty($this->selectedJenis)) {
                $nilaiQuery->where('jenis', $this->selectedJenis);
            }

            $records = $nilaiQuery->get();

            $totalRata = $records->count() > 0 ? round($records->avg('nilai'), 1) : null;
            $tugasAvg  = $records->where('jenis', 'tugas')->count() > 0 ? round($records->where('jenis', 'tugas')->avg('nilai'), 1) : '-';
            $uhAvg     = $records->where('jenis', 'uh')->count() > 0 ? round($records->where('jenis', 'uh')->avg('nilai'), 1) : '-';
            $ptsAvg    = $records->where('jenis', 'pts')->count() > 0 ? round($records->where('jenis', 'pts')->avg('nilai'), 1) : '-';
            $pasAvg    = $records->where('jenis', 'pas')->count() > 0 ? round($records->where('jenis', 'pas')->avg('nilai'), 1) : '-';

            $rekapNilai[$siswa->id] = [
                'tugas' => $tugasAvg,
                'uh' => $uhAvg,
                'pts' => $ptsAvg,
                'pas' => $pasAvg,
                'rata_rata' => $totalRata ?? '-',
                'jumlah_nilai' => $records->count(),
            ];
        }

        return view('livewire.waka.rekap-nilai', [
            'siswas' => $siswas,
            'rekapNilai' => $rekapNilai,
            'kelases' => $kelases,
            'mapels' => $mapels,
        ])->layout('layouts.app', ['header' => 'Rekapitulasi Nilai Formatif']);
    }
}
