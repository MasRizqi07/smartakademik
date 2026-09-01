<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\JadwalPelajaran;
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

        // 1. Admin/TU
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@smartakademik.test'],
            ['name' => 'Admin TU MAN 4', 'password' => bcrypt('password')]
        );
        $adminUser->syncRoles(['admin_tu']);

        // 2. Waka Kurikulum
        $wakaUser = User::firstOrCreate(
            ['email' => 'waka@smartakademik.test'],
            ['name' => 'Waka Kurikulum', 'password' => bcrypt('password')]
        );
        $wakaUser->syncRoles(['waka_kurikulum']);

        // 3. Guru 1 (Budi Santoso)
        $guruUser = User::firstOrCreate(
            ['email' => 'guru@smartakademik.test'],
            ['name' => 'Budi Santoso, S.Pd.', 'password' => bcrypt('password')]
        );
        $guruUser->syncRoles(['guru']);
        $guru = Guru::firstOrCreate(
            ['user_id' => $guruUser->id],
            ['nama' => 'Budi Santoso, S.Pd.', 'nip_nuptk' => '198501012010011001']
        );

        // 4. Guru 2 (Siti Aminah)
        $guru2User = User::firstOrCreate(
            ['email' => 'guru2@smartakademik.test'],
            ['name' => 'Siti Aminah, M.Pd.', 'password' => bcrypt('password')]
        );
        $guru2User->syncRoles(['guru']);
        $guru2 = Guru::firstOrCreate(
            ['user_id' => $guru2User->id],
            ['nama' => 'Siti Aminah, M.Pd.', 'nip_nuptk' => '199002022015022002']
        );

        // 5. Guru 3 (Drs. H. Ahmad Dahlan)
        $guru3User = User::firstOrCreate(
            ['email' => 'guru3@smartakademik.test'],
            ['name' => 'Drs. H. Ahmad Dahlan', 'password' => bcrypt('password')]
        );
        $guru3User->syncRoles(['guru']);
        $guru3 = Guru::firstOrCreate(
            ['user_id' => $guru3User->id],
            ['nama' => 'Drs. H. Ahmad Dahlan', 'nip_nuptk' => '197503032000031003']
        );

        // Master Kelas
        $kelasXA = Kelas::firstOrCreate(['nama_kelas' => 'X-A'], ['tingkat' => 'X']);
        $kelasXB = Kelas::firstOrCreate(['nama_kelas' => 'X-B'], ['tingkat' => 'X']);
        $kelasXIA = Kelas::firstOrCreate(['nama_kelas' => 'XI-MIPA-1'], ['tingkat' => 'XI']);
        $kelasXIIA = Kelas::firstOrCreate(['nama_kelas' => 'XII-MIPA-1'], ['tingkat' => 'XII']);

        // Master Mapel
        $mapelMtk = Mapel::firstOrCreate(['kode_mapel' => 'MTK'], ['nama_mapel' => 'Matematika']);
        $mapelFis = Mapel::firstOrCreate(['kode_mapel' => 'FIS'], ['nama_mapel' => 'Fisika']);
        $mapelBio = Mapel::firstOrCreate(['kode_mapel' => 'BIO'], ['nama_mapel' => 'Biologi']);
        $mapelQur = Mapel::firstOrCreate(['kode_mapel' => 'QUR'], ['nama_mapel' => "Al-Qur'an Hadis"]);
        $mapelFik = Mapel::firstOrCreate(['kode_mapel' => 'FIK'], ['nama_mapel' => 'Fikih Madrasah']);

        // Master Siswa & User Accounts
        $siswaData = [
            ['nama' => 'Ahmad Fauzi', 'nisn' => '0012345678', 'email' => 'siswa@smartakademik.test', 'kelas_id' => $kelasXA->id],
            ['nama' => 'Siti Nurhaliza', 'nisn' => '0012345679', 'email' => 'siti@smartakademik.test', 'kelas_id' => $kelasXB->id],
            ['nama' => 'Bagus Pratama', 'nisn' => '0012345680', 'email' => 'bagus@smartakademik.test', 'kelas_id' => $kelasXIA->id],
            ['nama' => 'Dewi Lestari', 'nisn' => '0012345681', 'email' => 'dewi@smartakademik.test', 'kelas_id' => $kelasXIIA->id],
        ];

        foreach ($siswaData as $sd) {
            $u = User::firstOrCreate(
                ['email' => $sd['email']],
                ['name' => $sd['nama'], 'password' => bcrypt('password')]
            );
            $u->syncRoles(['siswa']);

            Siswa::firstOrCreate(
                ['nisn' => $sd['nisn']],
                ['user_id' => $u->id, 'nama' => $sd['nama'], 'kelas_id' => $sd['kelas_id']]
            );
        }

        // Jadwal Mengajar Guru 1
        JadwalPelajaran::firstOrCreate([
            'kelas_id' => $kelasXA->id,
            'mapel_id' => $mapelMtk->id,
            'guru_id' => $guru->id,
            'hari' => 'Senin',
            'jam_ke' => 1,
        ], [
            'waktu_mulai' => '07:00',
            'waktu_selesai' => '07:45',
        ]);

        // Jadwal Mengajar Guru 2
        JadwalPelajaran::firstOrCreate([
            'kelas_id' => $kelasXB->id,
            'mapel_id' => $mapelFis->id,
            'guru_id' => $guru2->id,
            'hari' => 'Selasa',
            'jam_ke' => 2,
        ], [
            'waktu_mulai' => '08:30',
            'waktu_selesai' => '10:00',
        ]);

        // Jadwal Mengajar Guru 3
        JadwalPelajaran::firstOrCreate([
            'kelas_id' => $kelasXIA->id,
            'mapel_id' => $mapelQur->id,
            'guru_id' => $guru3->id,
            'hari' => 'Rabu',
            'jam_ke' => 1,
        ], [
            'waktu_mulai' => '07:00',
            'waktu_selesai' => '08:30',
        ]);
    }
}
