<?php

namespace App\Livewire;

use Livewire\Component;

class KontakSupport extends Component
{
    public $nama = '';
    public $emailOrId = '';
    public $kategori = 'login';
    public $pesan = '';

    public $ticketSearch = '';
    public $searchResult = null;
    public $submittedTicketId = null;

    public $chatMessages = [
        ['sender' => 'agent', 'time' => '10:00', 'text' => 'Halo! Ada kendala operasional portal yang bisa kami bantu?'],
    ];
    public $chatInput = '';

    public function submitTicket()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'emailOrId' => 'required|string|max:255',
            'kategori' => 'required',
            'pesan' => 'required|string|min:5',
        ]);

        $this->submittedTicketId = 'TK-' . rand(1000, 9999);
        session()->flash('ticket_success', "Tiket bantuan berhasil dibuat dengan nomor referensi #{$this->submittedTicketId}. Tim IT akan merespons dalam 15-30 menit.");

        $this->nama = '';
        $this->emailOrId = '';
        $this->pesan = '';
    }

    public function checkTicket()
    {
        if (empty($this->ticketSearch)) {
            $this->searchResult = null;
            return;
        }

        $query = strtoupper(trim($this->ticketSearch));
        $this->searchResult = [
            'ticket_id' => $query,
            'status' => 'Sedang Diproses (In Progress)',
            'priority' => 'Tinggi (High)',
            'updated_at' => '10 Menit yang lalu',
            'technician' => 'Rizki - IT Support Unit',
            'note' => 'Permintaan perbaikan hak akses kelas sedang diverifikasi oleh Tim Kurikulum.'
        ];
    }

    public function sendChat()
    {
        if (trim($this->chatInput) === '') return;

        $this->chatMessages[] = [
            'sender' => 'user',
            'time' => date('H:i'),
            'text' => $this->chatInput,
        ];

        $userQuery = strtolower($this->chatInput);
        $this->chatInput = '';

        // Simulated AI / IT Auto Response
        $reply = 'Terima kasih telah menghubungi kami. Pesan Anda telah dicatat oleh sistem.';
        if (str_contains($userQuery, 'password') || str_contains($userQuery, 'login')) {
            $reply = 'Untuk reset password, Anda dapat menggunakan tombol "Lupa Password" atau mendatangi ruang Tata Usaha dengan membawa NIP/NISN.';
        } elseif (str_contains($userQuery, 'absen') || str_contains($userQuery, 'presensi')) {
            $reply = 'Pastikan koneksi internet stabil saat input presensi. Tombol "Tandai Semua Hadir" dapat mempercepat pengisian.';
        } elseif (str_contains($userQuery, 'nilai') || str_contains($userQuery, 'tp')) {
            $reply = 'Nilai formatif TP 1-5 diisi rentang 0-100 dan sistem akan otomatis mengalkulasi rata-ratanya.';
        }

        $this->chatMessages[] = [
            'sender' => 'agent',
            'time' => date('H:i'),
            'text' => $reply,
        ];
    }

    public function render()
    {
        return view('livewire.kontak-support');
    }
}
