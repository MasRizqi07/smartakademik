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

        $siswaQuery = Siswa::query();

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
        foreach ($siswas as $s) {
            $s->setRelation('kelas', $kelases->firstWhere('id', $s->kelas_id));
        }

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

        $kkm = (int) (\App\Models\PengaturanAkademik::value('kkm_default') ?? 75);

        $kpiStats = NilaiFormatif::query()
            ->when(!empty($this->selectedKelas), function($q) {
                $q->whereHas('siswa', fn($sq) => $sq->where('kelas_id', $this->selectedKelas));
            })
            ->when(!empty($this->selectedMapel), fn($q) => $q->where('mapel_id', $this->selectedMapel))
            ->when(!empty($this->selectedJenis), fn($q) => $q->where('jenis', $this->selectedJenis))
            ->selectRaw("COUNT(*) as total_count, AVG(nilai) as avg_nilai, SUM(CASE WHEN nilai >= {$kkm} THEN 1 ELSE 0 END) as tuntas_count, SUM(CASE WHEN nilai < {$kkm} THEN 1 ELSE 0 END) as remedial_count")
            ->first();

        $kpiTotal = $kpiStats ? (int)$kpiStats->total_count : 0;
        $kpiAvg = ($kpiTotal > 0 && $kpiStats->avg_nilai !== null) ? round((float)$kpiStats->avg_nilai, 1) : null;
        $kpiRataRata = $kpiAvg !== null ? (string)$kpiAvg : '-';
        $kpiKetuntasan = $kpiTotal > 0 ? number_format(($kpiStats->tuntas_count / $kpiTotal) * 100, 1) . '%' : '-';
        $kpiRemedial = $kpiTotal > 0 ? number_format(($kpiStats->remedial_count / $kpiTotal) * 100, 1) . '%' : '-';
        $kpiAvgSubtext = $kpiAvg !== null ? ($kpiAvg >= $kkm ? "Memenuhi KKM ({$kkm})" : "Di bawah KKM ({$kkm})") : 'Belum ada data';

        $rekapNilai = [];
        foreach ($siswas as $siswa) {
            $records = $nilaiByJenis->get($siswa->id, collect());

            $tugas = $records->firstWhere('jenis', 'tugas');
            $uh    = $records->firstWhere('jenis', 'uh');
            $pts   = $records->firstWhere('jenis', 'pts');
            $pas   = $records->firstWhere('jenis', 'pas');

            $tugasAvg = ($tugas && $tugas->count_nilai > 0) ? round((float)$tugas->avg_nilai, 1) : '-';
            $uhAvg    = ($uh && $uh->count_nilai > 0) ? round((float)$uh->avg_nilai, 1) : '-';
            $ptsAvg   = ($pts && $pts->count_nilai > 0) ? round((float)$pts->avg_nilai, 1) : '-';
            $pasAvg   = ($pas && $pas->count_nilai > 0) ? round((float)$pas->avg_nilai, 1) : '-';

            $sumNilai = 0;
            $totalCount = 0;
            foreach ($records as $rec) {
                $sumNilai += ((float)$rec->avg_nilai * (int)$rec->count_nilai);
                $totalCount += (int)$rec->count_nilai;
            }
            $totalRata = $totalCount > 0 ? round($sumNilai / $totalCount, 1) : null;

            $rekapNilai[$siswa->id] = [
                'tugas' => $tugasAvg,
                'uh' => $uhAvg,
                'pts' => $ptsAvg,
                'pas' => $pasAvg,
                'rata_rata' => $totalRata ?? '-',
                'jumlah_nilai' => $totalCount,
            ];
        }

        return view('livewire.waka.rekap-nilai', [
            'siswas' => $siswas,
            'rekapNilai' => $rekapNilai,
            'kelases' => $kelases,
            'mapels' => $mapels,
            'kpiRataRata' => $kpiRataRata,
            'kpiKetuntasan' => $kpiKetuntasan,
            'kpiRemedial' => $kpiRemedial,
            'kpiAvgSubtext' => $kpiAvgSubtext,
            'kpiTotal' => $kpiTotal,
            'kkm' => $kkm,
        ])->layout('layouts.app', ['header' => 'Rekapitulasi Nilai Formatif']);
    }
}
