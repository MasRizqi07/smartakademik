<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JadwalPelajaran extends Model
{
    protected $table = 'jadwal_pelajaran';

    protected $fillable = ['kelas_id', 'mapel_id', 'guru_id', 'hari', 'jam_ke', 'waktu_mulai', 'waktu_selesai'];

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class);
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class);
    }

    public function absensi(): HasMany
    {
        return $this->hasMany(Absensi::class, 'jadwal_id');
    }

    /**
     * Scope: hanya jadwal milik guru tertentu.
     * Ini yang di-enforce di level query, bukan cuma UI.
     */
    public function scopeForGuru(Builder $query, int $guruId): Builder
    {
        return $query->where('guru_id', $guruId);
    }

    /**
     * Scope: jadwal hari ini.
     */
    public function scopeHariIni(Builder $query): Builder
    {
        $hariMap = [
            'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu',
        ];
        $hari = $hariMap[now()->format('l')] ?? null;

        return $query->where('hari', $hari);
    }
}
