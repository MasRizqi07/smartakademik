<?php

namespace App\Livewire\Admin;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class SiswaManager extends Component
{
    use WithPagination;

    public $search = '';
    
    public $isFormOpen = false;
    public $siswaId = null;
    
    // Form fields
    public $nisn = '';
    public $nama = '';
    public $kelas_id = '';
    public $create_user_account = false;
    public $email = '';

    protected $rules = [
        'nisn' => 'required|string|max:20',
        'nama' => 'required|string|max:255',
        'kelas_id' => 'required|exists:kelas,id',
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
        $siswa = Siswa::findOrFail($id);
        $this->siswaId = $siswa->id;
        $this->nisn = $siswa->nisn;
        $this->nama = $siswa->nama;
        $this->kelas_id = $siswa->kelas_id;
        $this->isFormOpen = true;
    }

    public function store()
    {
        $rules = $this->rules;
        if (!$this->siswaId && $this->create_user_account) {
            $rules['email'] = 'required|email|unique:users,email';
        }
        $this->validate($rules);

        $userId = null;
        if (!$this->siswaId && $this->create_user_account) {
            $user = User::create([
                'name' => $this->nama,
                'email' => $this->email,
                'password' => Hash::make($this->nisn), // Default password is NISN
            ]);
            $user->assignRole('siswa');
            $userId = $user->id;
        }

        Siswa::updateOrCreate(
            ['id' => $this->siswaId],
            [
                'nisn' => $this->nisn,
                'nama' => $this->nama,
                'kelas_id' => $this->kelas_id,
                'user_id' => $this->siswaId ? Siswa::find($this->siswaId)->user_id : $userId,
            ]
        );

        $this->resetForm();
        session()->flash('message', $this->siswaId ? 'Siswa updated successfully.' : 'Siswa created successfully.');
    }

    public function delete($id)
    {
        Siswa::findOrFail($id)->delete();
        session()->flash('message', 'Siswa deleted successfully.');
    }

    public function resetForm()
    {
        $this->siswaId = null;
        $this->nisn = '';
        $this->nama = '';
        $this->kelas_id = '';
        $this->create_user_account = false;
        $this->email = '';
        $this->isFormOpen = false;
        $this->resetValidation();
    }

    public function render()
    {
        $query = Siswa::with(['kelas', 'user']);
        
        if ($this->search) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('nisn', 'like', '%' . $this->search . '%');
        }

        return view('livewire.admin.siswa-manager', [
            'siswas' => $query->paginate(10),
            'kelases' => Kelas::all(),
        ])->layout('layouts.app', ['header' => 'Kelola Data Siswa']);
    }
}
