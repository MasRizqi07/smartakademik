<?php

namespace App\Policies;

use App\Models\Absensi;
use App\Models\JadwalPelajaran;
use App\Models\User;

class AbsensiPolicy
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
    public function view(User $user, Absensi $absensi): bool
    {
        if ($user->hasRole(['admin_tu', 'waka_kurikulum'])) {
            return true;
        }

        if ($user->hasRole('guru')) {
            // Guru only sees absensi for their own jadwal
            return $absensi->jadwal->guru->user_id === $user->id;
        }

        if ($user->hasRole('siswa')) {
            // Siswa only sees their own absensi
            return $absensi->siswa->user_id === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can create models (input absensi).
     * Usually passed with a JadwalPelajaran context.
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
    public function update(User $user, Absensi $absensi): bool
    {
        if ($user->hasRole('guru')) {
            return $absensi->jadwal->guru->user_id === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Absensi $absensi): bool
    {
        return false; // Absensi generally shouldn't be deleted, only updated
    }
}
