<?php

namespace App\Imports;

use App\Models\Mapel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class MapelImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsOnError
{
    use SkipsFailures, SkipsErrors;

    public function model(array $row)
    {
        return new Mapel([
            'kode_mapel' => $row['kode_mapel'],
            'nama_mapel' => $row['nama_mapel'],
        ]);
    }

    public function rules(): array
    {
        return [
            'kode_mapel' => 'required|string|unique:mapel,kode_mapel',
            'nama_mapel' => 'required|string|max:255',
        ];
    }
}
