<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanAkademik extends Model
{
    protected $table = 'pengaturan_akademik';

    protected $fillable = [
        'tahun_ajaran',
        'semester_aktif',
        'nama_madrasah',
        'npsn',
        'nsm',
        'kepala_sekolah',
        'nip_kepsek',
        'alamat_madrasah',
        'email_madrasah',
        'telepon_madrasah',
        'kkm_default',
        'durasi_jam_kbm',
    ];

    protected function casts(): array
    {
        return [
            'kkm_default' => 'integer',
            'durasi_jam_kbm' => 'integer',
        ];
    }
}
