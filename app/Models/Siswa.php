<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = ['nisn', 'nama', 'kelas_id', 'user_id'];

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function absensi(): HasMany
    {
        return $this->hasMany(Absensi::class);
    }

    public function nilaiFormatif(): HasMany
    {
        return $this->hasMany(NilaiFormatif::class);
    }
}
