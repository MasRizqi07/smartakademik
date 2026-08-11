<?php

namespace App\Livewire\Admin;

use App\Imports\SiswaImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ImportExcel extends Component
{
    use WithFileUploads;

    public $file;
    public $failures = [];
    public $successCount = 0;
    public $isImporting = false;

    public function rules()
    {
        return [
            'file' => 'required|mimes:xlsx,xls,csv|max:2048', // max 2MB
        ];
    }

    public function downloadTemplate(): StreamedResponse
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="template_import_siswa.csv"',
        ];
        
        $callback = function() {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['nisn', 'nama', 'tingkat', 'nama_kelas']);
            fputcsv($file, ['1234567890', 'Budi Santoso', 'X', 'X-A']);
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
            $import = new SiswaImport;
            Excel::import($import, $this->file);
            
            $this->failures = $import->failures();
            $this->successCount = session('import_success_count', 0); // we might need to track this if possible, but Laravel Excel doesn't give a straight count easily without events. 
            // We'll just say "Import selesai."
            
            if (count($this->failures) > 0) {
                session()->flash('warning', 'Import selesai dengan beberapa error pada baris tertentu.');
            } else {
                session()->flash('message', 'Semua data berhasil diimport!');
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
