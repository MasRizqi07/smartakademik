<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class PengaturanManager extends Component
{
    public $tahunAjaran = '2026/2027';
    public $semesterAktif = 'Ganjil';
    public $namaMadrasah = 'MAN 4 Jombang';
    public $npsn = '20584123';
    public $nsm = '131135170004';
    public $kepalaSekolah = 'Drs. H. Syamsul Huda, M.Pd.I';
    public $nipKepsek = '196805121994031003';
    public $alamatMadrasah = 'Jl. Raya Jombang - Babat No. 123, Denanyar, Jombang, Jawa Timur';
    public $emailMadrasah = 'info@man4jombang.sch.id';
    public $teleponMadrasah = '(0321) 861234';
    public $kkmDefault = 75;
    public $durasiJamKbm = 45; // menit

    public function saveSettings()
    {
        $this->validate([
            'namaMadrasah' => 'required|string|max:255',
            'npsn' => 'required',
            'nsm' => 'required',
            'kkmDefault' => 'required|numeric|min:50|max:100',
        ]);

        session()->flash('message', 'Konfigurasi parameter akademik dan profil madrasah berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.admin.pengaturan-manager')->layout('layouts.app', ['header' => 'Pengaturan Akademik']);
    }
}
