<?php

namespace App\Livewire\Admin;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class GuruManager extends Component
{
    use WithPagination;

    public $search = '';
    
    public $isFormOpen = false;
    public $guruId = null;
    
    // Form fields
    public $nip_nuptk = '';
    public $nama = '';
    public $create_user_account = false;
    public $email = '';

    protected $rules = [
        'nip_nuptk' => 'required|string|max:50',
        'nama' => 'required|string|max:255',
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
        $guru = Guru::findOrFail($id);
        $this->guruId = $guru->id;
        $this->nip_nuptk = $guru->nip_nuptk;
        $this->nama = $guru->nama;
        $this->isFormOpen = true;
    }

    public function store()
    {
        $rules = $this->rules;
        if (!$this->guruId && $this->create_user_account) {
            $rules['email'] = 'required|email|unique:users,email';
        }
        $this->validate($rules);

        $userId = null;
        if (!$this->guruId && $this->create_user_account) {
            $user = User::create([
                'name' => $this->nama,
                'email' => $this->email,
                'password' => Hash::make($this->nip_nuptk), // Default password is NIP/NUPTK
            ]);
            $user->assignRole('guru');
            $userId = $user->id;
        }

        Guru::updateOrCreate(
            ['id' => $this->guruId],
            [
                'nip_nuptk' => $this->nip_nuptk,
                'nama' => $this->nama,
                'user_id' => $this->guruId ? Guru::find($this->guruId)->user_id : $userId,
            ]
        );

        $this->resetForm();
        session()->flash('message', $this->guruId ? 'Guru updated successfully.' : 'Guru created successfully.');
    }

    public function delete($id)
    {
        Guru::findOrFail($id)->delete();
        session()->flash('message', 'Guru deleted successfully.');
    }

    public function resetForm()
    {
        $this->guruId = null;
        $this->nip_nuptk = '';
        $this->nama = '';
        $this->create_user_account = false;
        $this->email = '';
        $this->isFormOpen = false;
        $this->resetValidation();
    }

    public function render()
    {
        $query = Guru::with('user');
        
        if ($this->search) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('nip_nuptk', 'like', '%' . $this->search . '%');
        }

        return view('livewire.admin.guru-manager', [
            'gurus' => $query->paginate(10),
        ])->layout('layouts.app', ['header' => 'Kelola Data Guru']);
    }
}
