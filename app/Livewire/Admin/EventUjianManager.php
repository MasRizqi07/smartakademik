<?php

namespace App\Livewire\Admin;

use App\Models\EventUjian;
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

    public function openAddModal()
    {
        $this->namaUjian = '';
        $this->jenisUjian = 'PTS Ganjil';
        $this->tanggalUjian = date('Y-m-d');
        $this->waktuUjian = '07:30 - 09:30';
        $this->ruangan = 'Ruang 01';
        $this->pengawasNama = Guru::first()?->nama ?? 'Ahmad Fauzi, S.Pd.';
        $this->isAddOpen = true;
    }

    public function saveEvent()
    {
        $this->validate([
            'namaUjian' => 'required|string|max:255',
            'jenisUjian' => 'required|in:PTS Ganjil,PAS Ganjil,PTS Genap,PAT/AAT,Asesmen Madrasah',
            'tanggalUjian' => 'required|date',
            'waktuUjian' => 'required|string|max:255',
            'ruangan' => 'required|string|max:255',
            'pengawasNama' => 'required|string|max:255',
        ]);

        EventUjian::create([
            'nama' => $this->namaUjian,
            'jenis' => $this->jenisUjian,
            'tanggal' => $this->tanggalUjian,
            'waktu' => $this->waktuUjian,
            'ruangan' => $this->ruangan,
            'pengawas_nama' => $this->pengawasNama,
            'peserta' => null,
            'status' => 'Terjadwal',
        ]);

        $this->isAddOpen = false;
        session()->flash('message', 'Jadwal event ujian & asesmen berhasil ditambahkan!');
    }

    public function deleteEvent($id)
    {
        EventUjian::findOrFail($id)->delete();
        session()->flash('message', 'Event asesmen berhasil dihapus.');
    }

    public function render()
    {
        $query = EventUjian::query();

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('ruangan', 'like', '%' . $this->search . '%')
                  ->orWhere('pengawas_nama', 'like', '%' . $this->search . '%');
            });
        }

        if (!empty($this->filterJenis)) {
            $query->where('jenis', $this->filterJenis);
        }

        $eventList = $query->orderBy('tanggal')->get();

        return view('livewire.admin.event-ujian-manager', [
            'eventList' => $eventList,
            'gurus' => Guru::all(),
            'kelases' => Kelas::all(),
            'mapels' => Mapel::all(),
        ])->layout('layouts.app', ['header' => 'Manajemen Event & Ujian']);
    }
}
