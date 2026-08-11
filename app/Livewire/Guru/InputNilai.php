<?php

namespace App\Livewire\Guru;

use App\Models\JadwalPelajaran;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class InputNilai extends Component
{
    use AuthorizesRequests;

    public JadwalPelajaran $jadwal;

    public function mount(JadwalPelajaran $jadwal)
    {
        $this->authorize('create', [\App\Models\NilaiFormatif::class, $jadwal]);
        $this->jadwal = $jadwal;
    }

    public function render()
    {
        return view('livewire.guru.input-nilai');
    }
}
