<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Illuminate\Validation\Rule;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsOnError
{
    use SkipsFailures, SkipsErrors;

    public function model(array $row)
    {
        // Cari kelas_id berdasarkan tingkat dan nama_kelas
        $kelas = Kelas::where('tingkat', $row['tingkat'])
                      ->where('nama_kelas', $row['nama_kelas'])
                      ->first();

        if (!$kelas) {
            return null; // Should be caught by validation, but just in case
        }

        $email = $row['nisn'] . '@siswa.smartakademik.local';
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $row['nama'],
                'password' => Hash::make($row['nisn']),
                'must_change_password' => true,
            ]
        );
        $user->assignRole('siswa');

        return new Siswa([
            'nisn'     => $row['nisn'],
            'nama'     => $row['nama'],
            'kelas_id' => $kelas->id,
            'user_id'  => $user->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'nisn' => 'required|unique:siswa,nisn',
            'nama' => 'required|string|max:255',
            'tingkat' => 'required|string',
            'nama_kelas' => 'required|string|exists:kelas,nama_kelas',
        ];
    }
}
