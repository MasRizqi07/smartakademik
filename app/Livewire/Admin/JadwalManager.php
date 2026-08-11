<?php

namespace App\Livewire\Admin;

use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Mapel;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class JadwalManager extends Component
{
    use WithPagination;

    public $search = '';
    
    public $isFormOpen = false;
    public $jadwalId = null;
    
    // Form fields
    public $kelas_id = '';
    public $mapel_id = '';
    public $guru_id = '';
    public $hari = '';
    public $jam_ke = '';
    public $waktu_mulai = '';
    public $waktu_selesai = '';

    protected function rules()
    {
        return [
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapel,id',
            'guru_id' => 'required|exists:guru,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_ke' => 'required|integer|min:1|max:15',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ];
    }

    public function updatingSearch()
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
        $this->kelas_id = $jadwal->kelas_id;
        $this->mapel_id = $jadwal->mapel_id;
        $this->guru_id = $jadwal->guru_id;
        $this->hari = $jadwal->hari;
        $this->jam_ke = $jadwal->jam_ke;
        $this->waktu_mulai = substr($jadwal->waktu_mulai, 0, 5);
        $this->waktu_selesai = substr($jadwal->waktu_selesai, 0, 5);
        
        $this->isFormOpen = true;
    }

    public function store()
    {
        $this->validate();

        // Check Unique Constraint for Guru
        $guruClash = JadwalPelajaran::where('guru_id', $this->guru_id)
            ->where('hari', $this->hari)
            ->where('jam_ke', $this->jam_ke);
        if ($this->jadwalId) {
            $guruClash->where('id', '!=', $this->jadwalId);
        }
        if ($guruClash->exists()) {
            $this->addError('jam_ke', 'Guru sudah memiliki jadwal pada hari dan jam ke- tersebut.');
            return;
        }

        // Check Unique Constraint for Kelas
        $kelasClash = JadwalPelajaran::where('kelas_id', $this->kelas_id)
            ->where('hari', $this->hari)
            ->where('jam_ke', $this->jam_ke);
        if ($this->jadwalId) {
            $kelasClash->where('id', '!=', $this->jadwalId);
        }
        if ($kelasClash->exists()) {
            $this->addError('jam_ke', 'Kelas sudah memiliki pelajaran pada hari dan jam ke- tersebut.');
            return;
        }

        JadwalPelajaran::updateOrCreate(
            ['id' => $this->jadwalId],
            [
                'kelas_id' => $this->kelas_id,
                'mapel_id' => $this->mapel_id,
                'guru_id' => $this->guru_id,
                'hari' => $this->hari,
                'jam_ke' => $this->jam_ke,
                'waktu_mulai' => $this->waktu_mulai,
                'waktu_selesai' => $this->waktu_selesai,
            ]
        );

        $this->resetForm();
        session()->flash('message', $this->jadwalId ? 'Jadwal updated successfully.' : 'Jadwal created successfully.');
    }

    public function delete($id)
    {
        JadwalPelajaran::findOrFail($id)->delete();
        session()->flash('message', 'Jadwal deleted successfully.');
    }

    public function resetForm()
    {
        $this->jadwalId = null;
        $this->kelas_id = '';
        $this->mapel_id = '';
        $this->guru_id = '';
        $this->hari = '';
        $this->jam_ke = '';
        $this->waktu_mulai = '';
        $this->waktu_selesai = '';
        $this->isFormOpen = false;
        $this->resetValidation();
    }

    public function render()
    {
        $query = JadwalPelajaran::with(['kelas', 'mapel', 'guru']);
        
        if ($this->search) {
            $query->whereHas('kelas', function($q) {
                $q->where('nama_kelas', 'like', '%' . $this->search . '%');
            })->orWhereHas('guru', function($q) {
                $q->where('nama', 'like', '%' . $this->search . '%');
            })->orWhereHas('mapel', function($q) {
                $q->where('nama_mapel', 'like', '%' . $this->search . '%');
            });
        }

        $query->orderBy('hari')->orderBy('jam_ke');

        return view('livewire.admin.jadwal-manager', [
            'jadwals' => $query->paginate(15),
            'kelases' => Kelas::all(),
            'mapels' => Mapel::all(),
            'gurus' => Guru::all(),
        ])->layout('layouts.app', ['header' => 'Kelola Jadwal Pelajaran']);
    }
}
