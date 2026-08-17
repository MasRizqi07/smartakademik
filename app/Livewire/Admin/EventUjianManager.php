<?php

namespace App\Livewire\Admin;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use Livewire\Component;

class EventUjianManager extends Component
{
    public $search = '';
    public $filterJenis = '';

    public $isAddOpen = false;
    public $namaUjian = '';
    public $jenisUjian = 'PTS Ganjil'; // PTS Ganjil, PAS Ganjil, PTS Genap, PAT/AAT, Asesmen Madrasah
    public $tanggalUjian = '';
    public $waktuUjian = '07:30 - 09:30';
    public $ruangan = 'Ruang 01';
    public $pengawasNama = 'Ahmad Fauzi, S.Pd.';
    public $status = 'Terjadwal';

    public $events = [
        ['id' => 1, 'nama' => 'Penilaian Tengah Semester (PTS) Ganjil - Matematika', 'jenis' => 'PTS Ganjil', 'tanggal' => '15 Sep 2026', 'waktu' => '07:30 - 09:30', 'ruang' => 'Ruang 01 (Lab IPA)', 'pengawas' => 'Ahmad Fauzi, S.Pd.', 'peserta' => 32, 'status' => 'Terjadwal'],
        ['id' => 2, 'nama' => 'PTS Ganjil - Bahasa Indonesia & Sastra', 'jenis' => 'PTS Ganjil', 'tanggal' => '16 Sep 2026', 'waktu' => '07:30 - 09:30', 'ruang' => 'Ruang 02', 'pengawas' => 'Siti Aminah, M.Pd.', 'peserta' => 30, 'status' => 'Terjadwal'],
        ['id' => 3, 'nama' => 'PTS Ganjil - Pendidikan Agama Islam (PAI)', 'jenis' => 'PTS Ganjil', 'tanggal' => '17 Sep 2026', 'waktu' => '07:30 - 09:30', 'ruang' => 'Ruang 03', 'pengawas' => 'K.H. Nur Hadi', 'peserta' => 32, 'status' => 'Terjadwal'],
        ['id' => 4, 'nama' => 'Penilaian Akhir Semester (PAS) - Fisika & Kimia', 'jenis' => 'PAS Ganjil', 'tanggal' => '02 Des 2026', 'waktu' => '08:00 - 10:00', 'ruang' => 'Lab Komputer', 'pengawas' => 'Budi Santoso, S.Kom.', 'peserta' => 36, 'status' => 'Persiapan'],
        ['id' => 5, 'nama' => 'Asesmen Bakat Skolastik (ABM) Madrasah', 'jenis' => 'Asesmen Madrasah', 'tanggal' => '10 Nov 2026', 'waktu' => '07:30 - 11:30', 'ruang' => 'Aula Utama', 'pengawas' => 'Tim Kurikulum', 'peserta' => 120, 'status' => 'Terjadwal'],
    ];

    public function openAddModal()
    {
        $this->namaUjian = '';
        $this->jenisUjian = 'PTS Ganjil';
        $this->tanggalUjian = date('Y-m-d');
        $this->waktuUjian = '07:30 - 09:30';
        $this->ruangan = 'Ruang 01';
        $this->pengawasNama = 'Ahmad Fauzi, S.Pd.';
        $this->isAddOpen = true;
    }

    public function saveEvent()
    {
        $this->validate([
            'namaUjian' => 'required|string|max:255',
            'tanggalUjian' => 'required',
            'ruangan' => 'required',
        ]);

        $this->events[] = [
            'id' => count($this->events) + 1,
            'nama' => $this->namaUjian,
            'jenis' => $this->jenisUjian,
            'tanggal' => date('d M Y', strtotime($this->tanggalUjian)),
            'waktu' => $this->waktuUjian,
            'ruang' => $this->ruangan,
            'pengawas' => $this->pengawasNama,
            'peserta' => rand(25, 36),
            'status' => 'Terjadwal',
        ];

        $this->isAddOpen = false;
        session()->flash('message', 'Jadwal event ujian & asesmen berhasil ditambahkan!');
    }

    public function deleteEvent($id)
    {
        $this->events = array_values(array_filter($this->events, fn($e) => $e['id'] != $id));
        session()->flash('message', 'Event asesmen berhasil dihapus.');
    }

    public function render()
    {
        $filtered = collect($this->events);

        if (!empty($this->search)) {
            $filtered = $filtered->filter(function($e) {
                return str_contains(strtolower($e['nama']), strtolower($this->search)) ||
                       str_contains(strtolower($e['ruang']), strtolower($this->search)) ||
                       str_contains(strtolower($e['pengawas']), strtolower($this->search));
            });
        }

        if (!empty($this->filterJenis)) {
            $filtered = $filtered->where('jenis', $this->filterJenis);
        }

        return view('livewire.admin.event-ujian-manager', [
            'eventList' => $filtered,
            'gurus' => Guru::all(),
            'kelases' => Kelas::all(),
            'mapels' => Mapel::all(),
        ])->layout('layouts.app', ['header' => 'Manajemen Event & Ujian']);
    }
}
