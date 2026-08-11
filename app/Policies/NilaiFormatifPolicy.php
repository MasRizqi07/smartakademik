<?php

namespace App\Policies;

use App\Models\NilaiFormatif;
use App\Models\JadwalPelajaran;
use App\Models\User;

class NilaiFormatifPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['admin_tu', 'waka_kurikulum', 'guru']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, NilaiFormatif $nilaiFormatif): bool
    {
        if ($user->hasRole(['admin_tu', 'waka_kurikulum'])) {
            return true;
        }

        if ($user->hasRole('guru')) {
            // Guru only sees their own input
            return $nilaiFormatif->guru->user_id === $user->id;
        }

        if ($user->hasRole('siswa')) {
            // Siswa only sees their own nilai
            return $nilaiFormatif->siswa->user_id === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can create models (input nilai).
     * Usually passed with a JadwalPelajaran context to know which mapel/kelas is targeted.
     */
    public function create(User $user, JadwalPelajaran $jadwal): bool
    {
        if ($user->hasRole('guru')) {
            return $jadwal->guru->user_id === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, NilaiFormatif $nilaiFormatif): bool
    {
        if ($user->hasRole('guru')) {
            return $nilaiFormatif->guru->user_id === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, NilaiFormatif $nilaiFormatif): bool
    {
        return false;
    }
}
