<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $roles = ['admin_tu', 'waka_kurikulum', 'guru', 'siswa'];
        foreach ($roles as $role) {
            Role::findOrCreate($role, 'web');
        }

        // Admin/TU
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@smartakademik.test'],
            ['name' => 'Admin TU', 'password' => bcrypt('password')]
        );
        $adminUser->assignRole('admin_tu');

        // Waka Kurikulum
        $wakaUser = User::firstOrCreate(
            ['email' => 'waka@smartakademik.test'],
            ['name' => 'Waka Kurikulum', 'password' => bcrypt('password')]
        );
        $wakaUser->assignRole('waka_kurikulum');

        // Guru — also create guru record linked to user
        $guruUser = User::firstOrCreate(
            ['email' => 'guru@smartakademik.test'],
            ['name' => 'Budi Santoso', 'password' => bcrypt('password')]
        );
        $guruUser->assignRole('guru');
        $guru = Guru::firstOrCreate(
            ['user_id' => $guruUser->id],
            ['nama' => 'Budi Santoso', 'nip_nuptk' => '198501012010011001']
        );

        // Guru 2 — for RBAC negative testing (different guru accessing other's class)
        $guru2User = User::firstOrCreate(
            ['email' => 'guru2@smartakademik.test'],
            ['name' => 'Siti Aminah', 'password' => bcrypt('password')]
        );
        $guru2User->assignRole('guru');
        $guru2 = Guru::firstOrCreate(
            ['user_id' => $guru2User->id],
            ['nama' => 'Siti Aminah', 'nip_nuptk' => '199002022015022002']
        );

        // Create sample kelas, mapel, siswa for testing
        $kelas = Kelas::firstOrCreate(
            ['nama_kelas' => 'X-A'],
            ['tingkat' => 'X']
        );

        $mapel = Mapel::firstOrCreate(
            ['kode_mapel' => 'MTK'],
            ['nama_mapel' => 'Matematika']
        );

        // Siswa — also create siswa record linked to user
        $siswaUser = User::firstOrCreate(
            ['email' => 'siswa@smartakademik.test'],
            ['name' => 'Ahmad Fauzi', 'password' => bcrypt('password')]
        );
        $siswaUser->assignRole('siswa');
        Siswa::firstOrCreate(
            ['user_id' => $siswaUser->id],
            ['nama' => 'Ahmad Fauzi', 'nisn' => '0012345678', 'kelas_id' => $kelas->id]
        );

        // Create jadwal for guru 1 (NOT guru 2) — for RBAC testing
        \App\Models\JadwalPelajaran::firstOrCreate([
            'kelas_id' => $kelas->id,
            'mapel_id' => $mapel->id,
            'guru_id' => $guru->id,
            'hari' => 'Senin',
            'jam_ke' => 1,
        ], [
            'waktu_mulai' => '07:00',
            'waktu_selesai' => '07:45',
        ]);
    }
}
