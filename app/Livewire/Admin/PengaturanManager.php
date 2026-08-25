<?php

namespace App\Livewire\Admin;

use App\Models\PengaturanAkademik;
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

    public function mount()
    {
        $pengaturan = PengaturanAkademik::first();
        if ($pengaturan) {
            $this->tahunAjaran = $pengaturan->tahun_ajaran;
            $this->semesterAktif = $pengaturan->semester_aktif;
            $this->namaMadrasah = $pengaturan->nama_madrasah;
            $this->npsn = $pengaturan->npsn;
            $this->nsm = $pengaturan->nsm;
            $this->kepalaSekolah = $pengaturan->kepala_sekolah;
            $this->nipKepsek = $pengaturan->nip_kepsek;
            $this->alamatMadrasah = $pengaturan->alamat_madrasah;
            $this->emailMadrasah = $pengaturan->email_madrasah;
            $this->teleponMadrasah = $pengaturan->telepon_madrasah;
            $this->kkmDefault = $pengaturan->kkm_default;
            $this->durasiJamKbm = $pengaturan->durasi_jam_kbm;
        }
    }

    public function saveSettings()
    {
        $this->validate([
            'namaMadrasah' => 'required|string|max:255',
            'npsn' => 'required|string|max:255',
            'nsm' => 'required|string|max:255',
            'kkmDefault' => 'required|numeric|min:50|max:100',
        ]);

        $data = [
            'tahun_ajaran' => $this->tahunAjaran,
            'semester_aktif' => $this->semesterAktif,
            'nama_madrasah' => $this->namaMadrasah,
            'npsn' => $this->npsn,
            'nsm' => $this->nsm,
            'kepala_sekolah' => $this->kepalaSekolah,
            'nip_kepsek' => $this->nipKepsek,
            'alamat_madrasah' => $this->alamatMadrasah,
            'email_madrasah' => $this->emailMadrasah,
            'telepon_madrasah' => $this->teleponMadrasah,
            'kkm_default' => (int) $this->kkmDefault,
            'durasi_jam_kbm' => (int) $this->durasiJamKbm,
        ];

        $pengaturan = PengaturanAkademik::first();
        if ($pengaturan) {
            $pengaturan->update($data);
        } else {
            PengaturanAkademik::create($data);
        }

        session()->flash('message', 'Konfigurasi parameter akademik dan profil madrasah berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.admin.pengaturan-manager')->layout('layouts.app', ['header' => 'Pengaturan Akademik']);
    }
}
