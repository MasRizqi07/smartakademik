<?php

namespace Tests\Feature;

use App\Livewire\Siswa\SiswaDashboard;
use App\Models\User;
use Database\Seeders\RoleAndUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SiswaDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected $siswaUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndUserSeeder::class);
        $this->siswaUser = User::where('email', 'siswa@smartakademik.test')->first();
    }

    public function test_siswa_dashboard_loads_properly()
    {
        // View dashboard directly via route
        $response = $this->actingAs($this->siswaUser)->get('/siswa/dashboard');
        $response->assertStatus(200);

        // Test Livewire component
        Livewire::actingAs($this->siswaUser)
            ->test(SiswaDashboard::class)
            ->assertSet('activeTab', 'jadwal')
            ->assertSee('Jadwal Pelajaran')
            ->set('activeTab', 'absensi')
            ->assertSee('Riwayat Absensi')
            ->set('activeTab', 'nilai')
            ->assertSee('Nilai Formatif');
    }

    public function test_guru_cannot_access_siswa_dashboard()
    {
        $guruUser = User::where('email', 'guru@smartakademik.test')->first();
        
        $response = $this->actingAs($guruUser)->get('/siswa/dashboard');
        $response->assertStatus(403);
    }

    public function test_two_students_with_different_data_see_different_computed_values()
    {
        $kelas = \App\Models\Kelas::first();
        $guru = \App\Models\Guru::first();
        $mapel = \App\Models\Mapel::first();

        // Student 1 (uses $this->siswaUser)
        $siswa1 = $this->siswaUser->siswa;
        
        // Student 2 with new user
        $user2 = User::factory()->create(['name' => 'Siswa Dua']);
        $user2->assignRole('siswa');
        $siswa2 = \App\Models\Siswa::create([
            'user_id' => $user2->id,
            'nisn' => '0099887766',
            'nama' => 'Siswa Dua',
            'kelas_id' => $kelas->id,
        ]);

        // Student 1: 9 hadir, 1 alfa = 90.0%; grades: 80, 90 -> avg 85
        for ($i = 1; $i <= 9; $i++) {
            \App\Models\Absensi::create([
                'siswa_id' => $siswa1->id,
                'jadwal_id' => 1,
                'tanggal' => "2026-08-" . sprintf('%02d', $i),
                'status' => 'hadir',
                'dicatat_oleh' => $guru->user_id,
            ]);
        }
        \App\Models\Absensi::create([
            'siswa_id' => $siswa1->id,
            'jadwal_id' => 1,
            'tanggal' => '2026-08-10',
            'status' => 'alfa',
            'dicatat_oleh' => $guru->user_id,
        ]);
        \App\Models\NilaiFormatif::create([
            'siswa_id' => $siswa1->id,
            'guru_id' => $guru->id,
            'mapel_id' => $mapel->id,
            'jenis' => 'tugas',
            'tanggal' => date('Y-m-d'),
            'nilai' => 80,
        ]);
        \App\Models\NilaiFormatif::create([
            'siswa_id' => $siswa1->id,
            'guru_id' => $guru->id,
            'mapel_id' => $mapel->id,
            'jenis' => 'tugas',
            'tanggal' => date('Y-m-d'),
            'nilai' => 90,
        ]);

        // Student 2: 5 hadir, 5 alfa = 50.0%; grades: 60, 70 -> avg 65
        for ($i = 1; $i <= 5; $i++) {
            \App\Models\Absensi::create([
                'siswa_id' => $siswa2->id,
                'jadwal_id' => 1,
                'tanggal' => "2026-08-" . sprintf('%02d', $i),
                'status' => 'hadir',
                'dicatat_oleh' => $guru->user_id,
            ]);
        }
        for ($i = 6; $i <= 10; $i++) {
            \App\Models\Absensi::create([
                'siswa_id' => $siswa2->id,
                'jadwal_id' => 1,
                'tanggal' => "2026-08-" . sprintf('%02d', $i),
                'status' => 'alfa',
                'dicatat_oleh' => $guru->user_id,
            ]);
        }
        \App\Models\NilaiFormatif::create([
            'siswa_id' => $siswa2->id,
            'guru_id' => $guru->id,
            'mapel_id' => $mapel->id,
            'jenis' => 'tugas',
            'tanggal' => date('Y-m-d'),
            'nilai' => 60,
        ]);
        \App\Models\NilaiFormatif::create([
            'siswa_id' => $siswa2->id,
            'guru_id' => $guru->id,
            'mapel_id' => $mapel->id,
            'jenis' => 'tugas',
            'tanggal' => date('Y-m-d'),
            'nilai' => 70,
        ]);

        // Assert Student 1 sees 90.0% and 85, does not see 98.2% or 88.5
        Livewire::actingAs($this->siswaUser)
            ->test(SiswaDashboard::class)
            ->assertSee('90.0%')
            ->assertSee('85')
            ->assertDontSee('98.2%')
            ->assertDontSee('88.5')
            ->assertDontSee('Sangat Baik')
            ->assertDontSee('Di atas KKM (75)');

        // Assert Student 2 sees 50.0% and 65, does not see 98.2% or 88.5
        Livewire::actingAs($user2)
            ->test(SiswaDashboard::class)
            ->assertSee('50.0%')
            ->assertSee('65')
            ->assertDontSee('98.2%')
            ->assertDontSee('88.5')
            ->assertDontSee('Sangat Baik')
            ->assertDontSee('Di atas KKM (75)');
    }
}
