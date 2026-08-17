<?php

namespace App\Livewire\Guru;

use App\Models\Guru;
use App\Models\JadwalPelajaran;
use Livewire\Component;

class ProfilGuru extends Component
{
    public $guru;
    public $nama;
    public $nip;
    public $email;
    public $phone = '+62 812-3456-7890';
    public $golongan = 'PNS Gol. IV/a';
    public $isEditOpen = false;

    public function mount()
    {
        $user = auth()->user();
        $this->guru = Guru::where('user_id', $user->id)->first() ?? Guru::first();
        
        if ($this->guru) {
            $this->nama = $this->guru->nama;
            $this->nip = $this->guru->nip_nuptk;
            $this->email = $user->email;
        } else {
            $this->nama = $user->name;
            $this->nip = '198501012010011001';
            $this->email = $user->email;
        }
    }

    public function openEdit()
    {
        $this->isEditOpen = true;
    }

    public function updateProfile()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:30',
            'phone' => 'required|string|max:20',
        ]);

        if ($this->guru) {
            $this->guru->update([
                'nama' => $this->nama,
                'nip_nuptk' => $this->nip,
            ]);
        }

        auth()->user()->update(['name' => $this->nama]);

        $this->isEditOpen = false;
        session()->flash('message', 'Profil tenaga pendidik berhasil diperbarui.');
    }

    public function render()
    {
        $jadwals = $this->guru 
            ? JadwalPelajaran::with(['kelas', 'mapel'])->where('guru_id', $this->guru->id)->get()
            : collect([]);

        return view('livewire.guru.profil-guru', [
            'jadwals' => $jadwals,
        ])->layout('layouts.app', ['header' => 'Profil Pendidik']);
    }
}
