<?php

namespace App\Livewire;

use Livewire\Component;

class PrestasiGaleri extends Component
{
    public $search = '';
    public $category = 'Semua';
    public $selectedYear = '2026/2027';

    public $isModalOpen = false;
    public $modalTitle = '';
    public $modalStudent = '';
    public $modalCategory = '';
    public $modalLevel = '';
    public $modalDate = '';
    public $modalDesc = '';

    // Add Achievement Modal state
    public $isAddOpen = false;
    public $newNamaSiswa = '';
    public $newKelas = '';
    public $newJudul = '';
    public $newKategori = 'Akademik';
    public $newTingkat = 'Nasional';
    public $newTanggal = '';
    public $newDeskripsi = '';

    public $achievements = [
        [
            'id' => 1,
            'judul' => 'Juara 1 Olimpiade Fisika Nasional',
            'siswa' => 'Ahmad Fauzi',
            'kelas' => 'XII MIPA 1',
            'kategori' => 'Akademik',
            'tingkat' => 'Nasional',
            'tanggal' => '12 Nov 2026',
            'deskripsi' => 'Meraih medali emas dengan skor tertinggi dalam ujian teori dan praktikum fisika mewakili Jawa Timur.',
            'featured' => true,
        ],
        [
            'id' => 2,
            'judul' => 'Juara 2 Lomba Debat Bahasa Inggris',
            'siswa' => 'Siti Aminah & Tim',
            'kelas' => 'XI MIPA 2',
            'kategori' => 'Akademik',
            'tingkat' => 'Provinsi',
            'tanggal' => '24 Okt 2026',
            'deskripsi' => 'East Java English Debate Championship diselenggarakan di Universitas Airlangga Surabaya.',
            'featured' => false,
        ],
        [
            'id' => 3,
            'judul' => 'Medali Emas Pencak Silat Popda',
            'siswa' => 'Budi Santoso',
            'kelas' => 'XI IPS 1',
            'kategori' => 'Olahraga',
            'tingkat' => 'Nasional',
            'tanggal' => '05 Sep 2026',
            'deskripsi' => 'Juara 1 kelas tanding C putra pada Pekan Olahraga Pelajar Daerah se-Jawa Timur.',
            'featured' => false,
        ],
        [
            'id' => 4,
            'judul' => 'Juara 1 Musabaqah Tilawatil Quran (MTQ)',
            'siswa' => 'Dimas Wahyu',
            'kelas' => 'X MIPA 3',
            'kategori' => 'Keagamaan',
            'tingkat' => 'Provinsi',
            'tanggal' => '21 Agu 2026',
            'deskripsi' => 'Pemenang cabang tilawah putra tingkat Madrasah Aliyah se-Jawa Timur.',
            'featured' => false,
        ],
        [
            'id' => 5,
            'judul' => 'Finalis Lomba Karya Tulis Ilmiah Remaja (LKIR)',
            'siswa' => 'Rina Novita',
            'kelas' => 'XII MIPA 2',
            'kategori' => 'Akademik',
            'tingkat' => 'Nasional',
            'tanggal' => '10 Agu 2026',
            'deskripsi' => 'Penelitian mengenai pemanfaatan limbah organik pertanian sebagai bioenergi ramah lingkungan.',
            'featured' => false,
        ],
        [
            'id' => 6,
            'judul' => 'Juara 1 Festival Seni Kaligrafi Islam',
            'siswa' => 'Zulfa Nur Hidayah',
            'kelas' => 'XI Keagamaan',
            'kategori' => 'Seni',
            'tingkat' => 'Kabupaten',
            'tanggal' => '15 Jul 2026',
            'deskripsi' => 'Kreasi kaligrafi kontemporer terbaik pada Porseni MA tingkat Kabupaten Jombang.',
            'featured' => false,
        ]
    ];

    public function openDetail($id)
    {
        $item = collect($this->achievements)->firstWhere('id', $id);
        if ($item) {
            $this->modalTitle = $item['judul'];
            $this->modalStudent = $item['siswa'] . ' (' . $item['kelas'] . ')';
            $this->modalCategory = $item['kategori'];
            $this->modalLevel = $item['tingkat'];
            $this->modalDate = $item['tanggal'];
            $this->modalDesc = $item['deskripsi'];
            $this->isModalOpen = true;
        }
    }

    public function openAdd()
    {
        $this->newNamaSiswa = '';
        $this->newKelas = '';
        $this->newJudul = '';
        $this->newKategori = 'Akademik';
        $this->newTingkat = 'Nasional';
        $this->newTanggal = date('d M Y');
        $this->newDeskripsi = '';
        $this->isAddOpen = true;
    }

    public function saveAchievement()
    {
        $this->validate([
            'newNamaSiswa' => 'required|string|max:255',
            'newKelas' => 'required|string|max:50',
            'newJudul' => 'required|string|max:255',
            'newDeskripsi' => 'required|string',
        ]);

        $newId = count($this->achievements) + 1;
        $this->achievements[] = [
            'id' => $newId,
            'judul' => $this->newJudul,
            'siswa' => $this->newNamaSiswa,
            'kelas' => $this->newKelas,
            'kategori' => $this->newKategori,
            'tingkat' => $this->newTingkat,
            'tanggal' => $this->newTanggal ?: date('d M Y'),
            'deskripsi' => $this->newDeskripsi,
            'featured' => false,
        ];

        $this->isAddOpen = false;
        session()->flash('message', 'Prestasi baru berhasil ditambahkan ke galeri!');
    }

    public function render()
    {
        $filtered = collect($this->achievements);

        if ($this->category !== 'Semua') {
            $filtered = $filtered->where('kategori', $this->category);
        }

        if (!empty($this->search)) {
            $query = strtolower($this->search);
            $filtered = $filtered->filter(function ($item) use ($query) {
                return str_contains(strtolower($item['judul']), $query) ||
                       str_contains(strtolower($item['siswa']), $query) ||
                       str_contains(strtolower($item['kategori']), $query) ||
                       str_contains(strtolower($item['tingkat']), $query);
            });
        }

        return view('livewire.prestasi-galeri', [
            'items' => $filtered,
            'totalCount' => count($this->achievements),
            'nationalCount' => collect($this->achievements)->where('tingkat', 'Nasional')->count(),
            'provincialCount' => collect($this->achievements)->where('tingkat', 'Provinsi')->count(),
        ]);
    }
}
