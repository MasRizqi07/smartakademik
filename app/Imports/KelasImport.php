<?php

namespace App\Imports;

use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class KelasImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsOnError
{
    use SkipsFailures, SkipsErrors;

    public function model(array $row)
    {
        return new Kelas([
            'nama_kelas' => $row['nama_kelas'],
            'tingkat' => $row['tingkat'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_kelas' => 'required|string|unique:kelas,nama_kelas',
            'tingkat' => 'required|string|in:X,XI,XII',
        ];
    }
}
