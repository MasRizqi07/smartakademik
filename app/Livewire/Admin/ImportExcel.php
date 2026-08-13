<?php

namespace App\Livewire\Admin;

use App\Imports\GuruImport;
use App\Imports\KelasImport;
use App\Imports\MapelImport;
use App\Imports\SiswaImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ImportExcel extends Component
{
    use WithFileUploads;

    public $type = 'siswa'; // 'siswa', 'guru', 'kelas', 'mapel'
    public $file;
    public $failures = [];
    public $successCount = 0;
    public $isImporting = false;

    public function rules()
    {
        return [
            'type' => 'required|in:siswa,guru,kelas,mapel',
            'file' => 'required|mimes:xlsx,xls,csv|max:2048', // max 2MB
        ];
    }

    public function downloadTemplate(): StreamedResponse
    {
        $filename = "template_import_{$this->type}.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];
        
        $type = $this->type;

        $callback = function() use ($type) {
            $file = fopen('php://output', 'w');
            if ($type === 'guru') {
                fputcsv($file, ['nip_nuptk', 'nama', 'email']);
                fputcsv($file, ['198501012010011002', 'Dewi Lestari', 'dewi@smartakademik.test']);
            } elseif ($type === 'kelas') {
                fputcsv($file, ['nama_kelas', 'tingkat']);
                fputcsv($file, ['X-B', 'X']);
            } elseif ($type === 'mapel') {
                fputcsv($file, ['kode_mapel', 'nama_mapel']);
                fputcsv($file, ['BIO', 'Biologi']);
            } else {
                fputcsv($file, ['nisn', 'nama', 'tingkat', 'nama_kelas']);
                fputcsv($file, ['1234567890', 'Budi Santoso', 'X', 'X-A']);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function import()
    {
        $this->validate();
        $this->failures = [];
        $this->successCount = 0;
        $this->isImporting = true;

        try {
            $importer = match ($this->type) {
                'guru' => new GuruImport,
                'kelas' => new KelasImport,
                'mapel' => new MapelImport,
                default => new SiswaImport,
            };

            Excel::import($importer, $this->file);
            
            $this->failures = $importer->failures();
            
            if (count($this->failures) > 0) {
                session()->flash('warning', 'Import selesai dengan beberapa error pada baris tertentu.');
            } else {
                session()->flash('message', 'Semua data ' . strtoupper($this->type) . ' berhasil diimport!');
            }
            
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }

        $this->isImporting = false;
        $this->reset('file');
    }

    public function render()
    {
        return view('livewire.admin.import-excel')->layout('layouts.app', ['header' => 'Import Data Massal']);
    }
}

