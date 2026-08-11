<?php

namespace App\Livewire\Admin;

use App\Models\Mapel;
use Livewire\Component;
use Livewire\WithPagination;

class MapelManager extends Component
{
    use WithPagination;

    public $search = '';
    
    public $isFormOpen = false;
    public $mapelId = null;
    
    // Form fields
    public $kode_mapel = '';
    public $nama_mapel = '';

    protected function rules()
    {
        return [
            'kode_mapel' => 'required|string|max:20|unique:mapel,kode_mapel,' . $this->mapelId,
            'nama_mapel' => 'required|string|max:100',
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
        $mapel = Mapel::findOrFail($id);
        $this->mapelId = $mapel->id;
        $this->kode_mapel = $mapel->kode_mapel;
        $this->nama_mapel = $mapel->nama_mapel;
        $this->isFormOpen = true;
    }

    public function store()
    {
        $this->validate();

        Mapel::updateOrCreate(
            ['id' => $this->mapelId],
            [
                'kode_mapel' => $this->kode_mapel,
                'nama_mapel' => $this->nama_mapel,
            ]
        );

        $this->resetForm();
        session()->flash('message', $this->mapelId ? 'Mapel updated successfully.' : 'Mapel created successfully.');
    }

    public function delete($id)
    {
        Mapel::findOrFail($id)->delete();
        session()->flash('message', 'Mapel deleted successfully.');
    }

    public function resetForm()
    {
        $this->mapelId = null;
        $this->kode_mapel = '';
        $this->nama_mapel = '';
        $this->isFormOpen = false;
        $this->resetValidation();
    }

    public function render()
    {
        $query = Mapel::query();
        
        if ($this->search) {
            $query->where('nama_mapel', 'like', '%' . $this->search . '%')
                  ->orWhere('kode_mapel', 'like', '%' . $this->search . '%');
        }

        return view('livewire.admin.mapel-manager', [
            'mapels' => $query->paginate(10),
        ])->layout('layouts.app', ['header' => 'Kelola Data Mata Pelajaran']);
    }
}
