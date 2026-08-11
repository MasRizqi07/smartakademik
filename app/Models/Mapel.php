<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mapel extends Model
{
    protected $table = 'mapel';

    protected $fillable = ['nama_mapel', 'kode_mapel'];

    public function jadwalPelajaran(): HasMany
    {
        return $this->hasMany(JadwalPelajaran::class);
    }

    public function nilaiFormatif(): HasMany
    {
        return $this->hasMany(NilaiFormatif::class);
    }
}
