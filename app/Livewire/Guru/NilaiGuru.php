<?php

namespace App\Livewire\Guru;

use App\Models\JadwalPelajaran;
use App\Models\NilaiFormatif;
use App\Models\Siswa;
use Livewire\Component;

class NilaiGuru extends Component
{
    public $kombinasiKelasMapel = []; // list of unique kelas & mapel pairs for the guru
    public $selectedKombinasi = ''; // Will hold "kelasId_mapelId"
    
    public $jenis = 'tugas';
    public $tanggal = '';
    
    public $siswas = [];
    public $nilaiData = []; // [siswa_id => nilai]

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->loadKombinasi();
    }

    public function loadKombinasi()
    {
        $guru = auth()->user()->guru;
        if (!$guru) {
            return;
        }

        // Get unique combinations of Kelas and Mapel taught by this Guru
        $jadwals = JadwalPelajaran::with(['kelas', 'mapel'])
            ->where('guru_id', $guru->id)
            ->get();
            
        $kombinasi = [];
        foreach ($jadwals as $j) {
            $key = $j->kelas_id . '_' . $j->mapel_id;
            if (!isset($kombinasi[$key])) {
                $kombinasi[$key] = [
                    'kelas_id' => $j->kelas_id,
                    'mapel_id' => $j->mapel_id,
                    'kelas_nama' => $j->kelas->nama_kelas,
                    'mapel_nama' => $j->mapel->nama_mapel,
                ];
            }
        }
        
        // Sort by kelas nama
        usort($kombinasi, function($a, $b) {
            return strcmp($a['kelas_nama'], $b['kelas_nama']);
        });
        
        $this->kombinasiKelasMapel = $kombinasi;
    }

    public function updatedSelectedKombinasi()
    {
        $this->loadSiswas();
    }
    
    public function updatedJenis()
    {
        $this->loadSiswas();
    }
    
    public function updatedTanggal()
    {
        $this->loadSiswas();
    }

    public function loadSiswas()
    {
        if (!$this->selectedKombinasi || !$this->tanggal || !$this->jenis) {
            $this->siswas = [];
            $this->nilaiData = [];
            return;
        }

        [$kelasId, $mapelId] = explode('_', $this->selectedKombinasi);

        $this->siswas = Siswa::where('kelas_id', $kelasId)->orderBy('nama')->get();

        $existing = NilaiFormatif::where('mapel_id', $mapelId)
            ->where('jenis', $this->jenis)
            ->where('tanggal', $this->tanggal)
            ->whereIn('siswa_id', $this->siswas->pluck('id'))
            ->get()
            ->keyBy('siswa_id');

        $this->nilaiData = [];
        foreach ($this->siswas as $siswa) {
            if ($existing->has($siswa->id)) {
                // Remove trailing zeros for display (e.g. 85.00 -> 85)
                $this->nilaiData[$siswa->id] = (float)$existing[$siswa->id]->nilai;
            } else {
                $this->nilaiData[$siswa->id] = '';
            }
        }
    }

    public function save()
    {
        if (!$this->selectedKombinasi || !$this->tanggal || !$this->jenis) {
            return;
        }
        
        $guru = auth()->user()->guru;
        if (!$guru) {
            return;
        }

        [$kelasId, $mapelId] = explode('_', $this->selectedKombinasi);

        foreach ($this->siswas as $siswa) {
            $nilaiStr = $this->nilaiData[$siswa->id] ?? '';
            if (trim((string)$nilaiStr) === '') {
                continue; // Skip empty values
            }
            
            $nilai = floatval($nilaiStr);
            if ($nilai < 0) $nilai = 0;
            if ($nilai > 100) $nilai = 100;

            NilaiFormatif::updateOrCreate(
                [
                    'siswa_id' => $siswa->id,
                    'mapel_id' => $mapelId,
                    'jenis' => $this->jenis,
                    'tanggal' => $this->tanggal,
                ],
                [
                    'nilai' => $nilai,
                    'guru_id' => $guru->id,
                ]
            );
        }

        session()->flash('message', 'Nilai berhasil disimpan!');
    }

    public function render()
    {
        return view('livewire.guru.nilai-guru')->layout('layouts.app', ['header' => 'Input Nilai Formatif']);
    }
}
