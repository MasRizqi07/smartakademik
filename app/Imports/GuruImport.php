<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class GuruImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsOnError
{
    use SkipsFailures, SkipsErrors;

    public function model(array $row)
    {
        $user = User::firstOrCreate(
            ['email' => $row['email']],
            [
                'name' => $row['nama'],
                'password' => Hash::make($row['nip_nuptk']),
                'must_change_password' => true,
            ]
        );
        $user->assignRole('guru');

        return new Guru([
            'user_id' => $user->id,
            'nip_nuptk' => $row['nip_nuptk'],
            'nama' => $row['nama'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nip_nuptk' => 'required|unique:guru,nip_nuptk',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ];
    }
}
