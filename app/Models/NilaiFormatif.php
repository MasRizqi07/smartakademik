<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NilaiFormatif extends Model
{
    protected $table = 'nilai_formatif';

    protected $fillable = ['siswa_id', 'mapel_id', 'jenis', 'nilai', 'tanggal', 'guru_id'];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'nilai' => 'decimal:2',
        ];
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class);
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class);
    }
}
