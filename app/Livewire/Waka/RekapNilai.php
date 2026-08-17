<?php

namespace App\Livewire\Waka;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\NilaiFormatif;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
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

        // Fetch grades for these students in a single aggregated query (eliminates N+1)
        $siswaIds = $siswas->pluck('id');

        $nilaiQuery = NilaiFormatif::whereIn('siswa_id', $siswaIds)
            ->when(!empty($this->selectedMapel), fn($q) => $q->where('mapel_id', $this->selectedMapel))
            ->when(!empty($this->selectedJenis), fn($q) => $q->where('jenis', $this->selectedJenis));

        $nilaiByJenis = (clone $nilaiQuery)
            ->select('siswa_id', 'jenis', DB::raw('avg(nilai) as avg_nilai'), DB::raw('count(*) as count_nilai'))
            ->groupBy('siswa_id', 'jenis')
            ->get()
            ->groupBy('siswa_id');

        $nilaiOverall = (clone $nilaiQuery)
            ->select('siswa_id', DB::raw('avg(nilai) as overall_avg'), DB::raw('count(*) as total_count'))
            ->groupBy('siswa_id')
            ->get()
            ->keyBy('siswa_id');

        $rekapNilai = [];
        foreach ($siswas as $siswa) {
            $records = $nilaiByJenis->get($siswa->id, collect());
            $overall = $nilaiOverall->get($siswa->id);

            $tugas = $records->firstWhere('jenis', 'tugas');
            $uh    = $records->firstWhere('jenis', 'uh');
            $pts   = $records->firstWhere('jenis', 'pts');
            $pas   = $records->firstWhere('jenis', 'pas');

            $tugasAvg = ($tugas && $tugas->count_nilai > 0) ? round((float)$tugas->avg_nilai, 1) : '-';
            $uhAvg    = ($uh && $uh->count_nilai > 0) ? round((float)$uh->avg_nilai, 1) : '-';
            $ptsAvg   = ($pts && $pts->count_nilai > 0) ? round((float)$pts->avg_nilai, 1) : '-';
            $pasAvg   = ($pas && $pas->count_nilai > 0) ? round((float)$pas->avg_nilai, 1) : '-';

            $totalRata = ($overall && $overall->total_count > 0) ? round((float)$overall->overall_avg, 1) : null;

            $rekapNilai[$siswa->id] = [
                'tugas' => $tugasAvg,
                'uh' => $uhAvg,
                'pts' => $ptsAvg,
                'pas' => $pasAvg,
                'rata_rata' => $totalRata ?? '-',
                'jumlah_nilai' => $overall ? (int)$overall->total_count : 0,
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
