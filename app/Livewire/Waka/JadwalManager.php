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

    // CRUD State
    public $isFormOpen = false;
    public $jadwalId = null;
    public $hari = 'Senin';
    public $jam_ke = 1;
    public $waktu_mulai = '07:00';
    public $waktu_selesai = '08:30';
    public $kelas_id = '';
    public $mapel_id = '';
    public $guru_id = '';

    protected $rules = [
        'hari' => 'required',
        'jam_ke' => 'required|integer|min:1|max:12',
        'waktu_mulai' => 'required',
        'waktu_selesai' => 'required',
        'kelas_id' => 'required|exists:kelas,id',
        'mapel_id' => 'required|exists:mapel,id',
        'guru_id' => 'required|exists:gurus,id',
    ];

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

    public function create()
    {
        $this->resetForm();
        $this->isFormOpen = true;
    }

    public function edit($id)
    {
        $this->resetForm();
        $jadwal = JadwalPelajaran::findOrFail($id);
        $this->jadwalId = $jadwal->id;
        $this->hari = $jadwal->hari;
        $this->jam_ke = $jadwal->jam_ke;
        $this->waktu_mulai = substr($jadwal->waktu_mulai, 0, 5);
        $this->waktu_selesai = substr($jadwal->waktu_selesai, 0, 5);
        $this->kelas_id = $jadwal->kelas_id;
        $this->mapel_id = $jadwal->mapel_id;
        $this->guru_id = $jadwal->guru_id;
        $this->isFormOpen = true;
    }

    public function store()
    {
        $this->validate();

        // Automated Conflict Detection: Guru schedule clash
        $conflictGuru = JadwalPelajaran::where('hari', $this->hari)
            ->where('jam_ke', $this->jam_ke)
            ->where('guru_id', $this->guru_id)
            ->when($this->jadwalId, fn($q) => $q->where('id', '!=', $this->jadwalId))
            ->with('kelas')
            ->first();

        if ($conflictGuru) {
            $this->addError('guru_id', "Bentrok Jadwal Guru! Guru ini sudah terjadwal mengajar di kelas {$conflictGuru->kelas->nama_kelas} pada {$this->hari} jam ke-{$this->jam_ke}.");
            return;
        }

        // Automated Conflict Detection: Kelas schedule clash
        $conflictKelas = JadwalPelajaran::where('hari', $this->hari)
            ->where('jam_ke', $this->jam_ke)
            ->where('kelas_id', $this->kelas_id)
            ->when($this->jadwalId, fn($q) => $q->where('id', '!=', $this->jadwalId))
            ->with('mapel')
            ->first();

        if ($conflictKelas) {
            $this->addError('kelas_id', "Bentrok Jadwal Kelas! Kelas ini sudah memiliki jadwal mata pelajaran {$conflictKelas->mapel->nama_mapel} pada {$this->hari} jam ke-{$this->jam_ke}.");
            return;
        }

        JadwalPelajaran::updateOrCreate(
            ['id' => $this->jadwalId],
            [
                'hari' => $this->hari,
                'jam_ke' => $this->jam_ke,
                'waktu_mulai' => $this->waktu_mulai,
                'waktu_selesai' => $this->waktu_selesai,
                'kelas_id' => $this->kelas_id,
                'mapel_id' => $this->mapel_id,
                'guru_id' => $this->guru_id,
            ]
        );

        $this->resetForm();
        session()->flash('message', $this->jadwalId ? 'Jadwal pelajaran berhasil diperbarui.' : 'Jadwal pelajaran baru berhasil ditambahkan tanpa konflik.');
    }

    public function delete($id)
    {
        JadwalPelajaran::findOrFail($id)->delete();
        session()->flash('message', 'Jadwal pelajaran berhasil dihapus.');
    }

    public function resetForm()
    {
        $this->jadwalId = null;
        $this->hari = 'Senin';
        $this->jam_ke = 1;
        $this->waktu_mulai = '07:00';
        $this->waktu_selesai = '08:30';
        $this->kelas_id = '';
        $this->mapel_id = '';
        $this->guru_id = '';
        $this->isFormOpen = false;
        $this->resetValidation();
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

        $jadwals = $query->orderBy('hari')->orderBy('jam_ke')->paginate(10);
        $kelases = Kelas::orderBy('nama_kelas')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();
        $gurus = Guru::orderBy('nama')->get();

        return view('livewire.waka.jadwal-manager', [
            'jadwals' => $jadwals,
            'kelases' => $kelases,
            'mapels' => $mapels,
            'gurus' => $gurus,
            'totalJadwal' => JadwalPelajaran::count(),
            'totalGuruMengajar' => JadwalPelajaran::distinct('guru_id')->count('guru_id'),
        ])->layout('layouts.app', ['header' => 'Manajemen Jadwal Pelajaran']);
    }
}
