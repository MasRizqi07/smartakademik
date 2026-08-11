<?php

namespace App\Livewire\Admin;

use App\Models\Guru;
use App\Models\Kelas;
use Livewire\Component;
use Livewire\WithPagination;

class KelasManager extends Component
{
    use WithPagination;

    public $search = '';
    
    public $isFormOpen = false;
    public $kelasId = null;
    
    public $nama_kelas = '';
    public $tingkat = '';
    public $wali_kelas_id = '';

    protected $rules = [
        'nama_kelas' => 'required|string|max:50',
        'tingkat' => 'required|string|max:20',
        'wali_kelas_id' => 'nullable|exists:guru,id',
    ];

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
        $kelas = Kelas::findOrFail($id);
        $this->kelasId = $kelas->id;
        $this->nama_kelas = $kelas->nama_kelas;
        $this->tingkat = $kelas->tingkat;
        $this->wali_kelas_id = $kelas->wali_kelas_id;
        $this->isFormOpen = true;
    }

    public function store()
    {
        $this->validate();

        Kelas::updateOrCreate(
            ['id' => $this->kelasId],
            [
                'nama_kelas' => $this->nama_kelas,
                'tingkat' => $this->tingkat,
                'wali_kelas_id' => $this->wali_kelas_id ?: null,
            ]
        );

        $this->resetForm();
        session()->flash('message', $this->kelasId ? 'Kelas updated successfully.' : 'Kelas created successfully.');
    }

    public function delete($id)
    {
        Kelas::findOrFail($id)->delete();
        session()->flash('message', 'Kelas deleted successfully.');
    }

    public function resetForm()
    {
        $this->kelasId = null;
        $this->nama_kelas = '';
        $this->tingkat = '';
        $this->wali_kelas_id = '';
        $this->isFormOpen = false;
        $this->resetValidation();
    }

    public function render()
    {
        $query = Kelas::with('waliKelas');
        
        if ($this->search) {
            $query->where('nama_kelas', 'like', '%' . $this->search . '%')
                  ->orWhere('tingkat', 'like', '%' . $this->search . '%');
        }

        return view('livewire.admin.kelas-manager', [
            'kelases' => $query->paginate(10),
            'gurus' => Guru::all(),
        ])->layout('layouts.app', ['header' => 'Kelola Data Kelas']);
    }
}
