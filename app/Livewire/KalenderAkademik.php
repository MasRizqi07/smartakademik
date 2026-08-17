<?php

namespace App\Livewire;

use Livewire\Component;

class KalenderAkademik extends Component
{
    public $activeSemester = 'Ganjil';
    public $activeYear = '2026/2027';
    public $selectedCategory = 'Semua';

    // Add Event Modal
    public $isAddOpen = false;
    public $eventTitle = '';
    public $eventDate = '';
    public $eventCategory = 'Kegiatan'; // Ujian, Libur, Kegiatan, Rapat
    public $eventDesc = '';

    public $events = [
        ['tanggal' => '15 Jul 2026', 'judul' => 'Hari Pertama Masuk Madrasah (T.A. 2026/2027)', 'kategori' => 'Kegiatan', 'color' => 'status-hadir', 'semester' => 'Ganjil'],
        ['tanggal' => '16-18 Jul 2026', 'judul' => 'MATSAMA (Masa Ta\'aruf Siswa Madrasah)', 'kategori' => 'Kegiatan', 'color' => 'status-izin', 'semester' => 'Ganjil'],
        ['tanggal' => '17 Agu 2026', 'judul' => 'Upacara HUT Kemerdekaan RI ke-81', 'kategori' => 'Libur', 'color' => 'status-alfa', 'semester' => 'Ganjil'],
        ['tanggal' => '15-20 Sep 2026', 'judul' => 'Penilaian Tengah Semester (PTS) Ganjil', 'kategori' => 'Ujian', 'color' => 'status-sakit', 'semester' => 'Ganjil'],
        ['tanggal' => '22 Okt 2026', 'judul' => 'Peringatan Hari Santri Nasional', 'kategori' => 'Kegiatan', 'color' => 'status-izin', 'semester' => 'Ganjil'],
        ['tanggal' => '25 Nov 2026', 'judul' => 'Peringatan Hari Guru Nasional', 'kategori' => 'Kegiatan', 'color' => 'status-izin', 'semester' => 'Ganjil'],
        ['tanggal' => '01-12 Des 2026', 'judul' => 'Penilaian Akhir Semester (PAS) Ganjil', 'kategori' => 'Ujian', 'color' => 'status-sakit', 'semester' => 'Ganjil'],
        ['tanggal' => '19 Des 2026', 'judul' => 'Pembagian Rapor Semester Ganjil', 'kategori' => 'Kegiatan', 'color' => 'status-hadir', 'semester' => 'Ganjil'],
        ['tanggal' => '21-31 Des 2026', 'judul' => 'Libur Akhir Semester Ganjil', 'kategori' => 'Libur', 'color' => 'status-alfa', 'semester' => 'Ganjil'],
        // Genap
        ['tanggal' => '05 Jan 2027', 'judul' => 'Hari Pertama Masuk Semester Genap', 'kategori' => 'Kegiatan', 'color' => 'status-hadir', 'semester' => 'Genap'],
        ['tanggal' => '01-06 Mar 2027', 'judul' => 'Penilaian Tengah Semester (PTS) Genap', 'kategori' => 'Ujian', 'color' => 'status-sakit', 'semester' => 'Genap'],
        ['tanggal' => '20-25 Mar 2027', 'judul' => 'Pondok Ramadhan & Pesantren Kilat', 'kategori' => 'Kegiatan', 'color' => 'status-izin', 'semester' => 'Genap'],
        ['tanggal' => '17-29 Mei 2027', 'judul' => 'Asesmen Akhir Tahun (AAT) / PAT', 'kategori' => 'Ujian', 'color' => 'status-sakit', 'semester' => 'Genap'],
        ['tanggal' => '19 Jun 2027', 'judul' => 'Pembagian Rapor & Wisuda Purnawiyata', 'kategori' => 'Kegiatan', 'color' => 'status-hadir', 'semester' => 'Genap'],
    ];

    public function openAddModal()
    {
        $this->eventTitle = '';
        $this->eventDate = date('Y-m-d');
        $this->eventCategory = 'Kegiatan';
        $this->eventDesc = '';
        $this->isAddOpen = true;
    }

    public function saveEvent()
    {
        $this->validate([
            'eventTitle' => 'required|string|max:255',
            'eventDate' => 'required',
            'eventCategory' => 'required',
        ]);

        $color = match($this->eventCategory) {
            'Ujian' => 'status-sakit',
            'Libur' => 'status-alfa',
            'Kegiatan' => 'status-izin',
            default => 'status-hadir',
        };

        $this->events[] = [
            'tanggal' => date('d M Y', strtotime($this->eventDate)),
            'judul' => $this->eventTitle,
            'kategori' => $this->eventCategory,
            'color' => $color,
            'semester' => $this->activeSemester,
        ];

        $this->isAddOpen = false;
        session()->flash('message', 'Agenda kegiatan akademik berhasil ditambahkan!');
    }

    public function render()
    {
        $filtered = collect($this->events)->where('semester', $this->activeSemester);

        if ($this->selectedCategory !== 'Semua') {
            $filtered = $filtered->where('kategori', $this->selectedCategory);
        }

        return view('livewire.kalender-akademik', [
            'filteredEvents' => $filtered,
        ]);
    }
}
