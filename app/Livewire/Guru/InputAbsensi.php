<?php

namespace App\Livewire\Guru;

use App\Models\JadwalPelajaran;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class InputAbsensi extends Component
{
    use AuthorizesRequests;

    public JadwalPelajaran $jadwal;

    public function mount(JadwalPelajaran $jadwal)
    {
        $this->authorize('create', [\App\Models\Absensi::class, $jadwal]);
        $this->jadwal = $jadwal;
    }

    public function render()
    {
        return view('livewire.guru.input-absensi');
    }
}
