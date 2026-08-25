<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventUjian extends Model
{
    protected $table = 'event_ujian';

    protected $fillable = [
        'nama',
        'jenis',
        'tanggal',
        'waktu',
        'ruangan',
        'pengawas_nama',
        'peserta',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'peserta' => 'integer',
        ];
    }
}
