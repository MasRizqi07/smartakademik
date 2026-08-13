<?php

namespace App\Livewire\Waka;

use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Mapel;
use Livewire\Component;
use Livewire\WithPagination;

class JadwalManager extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedHari = '';
    public $selectedKelas = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedHari()
    {
        $this->resetPage();
    }

    public function updatingSelectedKelas()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = JadwalPelajaran::with(['kelas', 'mapel', 'guru']);

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->whereHas('guru', function($g) {
                    $g->where('nama', 'like', '%' . $this->search . '%');
                })->orWhereHas('mapel', function($m) {
                    $m->where('nama_mapel', 'like', '%' . $this->search . '%');
                })->orWhereHas('kelas', function($k) {
                    $k->where('nama_kelas', 'like', '%' . $this->search . '%');
                });
            });
        }

        if (!empty($this->selectedHari)) {
            $query->where('hari', $this->selectedHari);
        }

        if (!empty($this->selectedKelas)) {
            $query->where('kelas_id', $this->selectedKelas);
        }

        $jadwals = $query->orderBy('hari')->orderBy('jam_ke')->paginate(15);
        $kelases = Kelas::orderBy('nama_kelas')->get();
        $gurus = Guru::orderBy('nama')->get();

        return view('livewire.waka.jadwal-manager', [
            'jadwals' => $jadwals,
            'kelases' => $kelases,
            'gurus' => $gurus,
        ])->layout('layouts.app', ['header' => 'Pengawasan Jadwal Pelajaran']);
    }
}
