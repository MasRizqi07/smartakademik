<?php

namespace Tests\Feature;

use App\Livewire\Guru\AbsensiGuru;
use App\Livewire\Guru\NilaiGuru;
use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\User;
use Database\Seeders\RoleAndUserSeeder;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RBACTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndUserSeeder::class);
    }

    public function test_guru_cannot_access_absensi_for_other_gurus_class()
    {
        // guru2 is Siti Aminah, she doesn't have any jadwal by default in seeder
        $guru2User = User::where('email', 'guru2@smartakademik.test')->first();
        $jadwal = JadwalPelajaran::first(); // this belongs to guru1 (Budi Santoso)

        Livewire::actingAs($guru2User)
            ->test(AbsensiGuru::class)
            ->set('selectedJadwalId', $jadwal->id)
            ->assertStatus(403);
    }

    public function test_guru_cannot_access_nilai_for_other_gurus_class()
    {
        $guru2User = User::where('email', 'guru2@smartakademik.test')->first();
        $jadwal = JadwalPelajaran::first(); // belongs to guru1

        Livewire::actingAs($guru2User)
            ->test(NilaiGuru::class)
            ->set('selectedKombinasi', $jadwal->kelas_id . '_' . $jadwal->mapel_id)
            ->assertStatus(403);
    }

    public function test_siswa_cannot_access_crud_endpoints()
    {
        $siswaUser = User::where('email', 'siswa@smartakademik.test')->first();

        // Admin TU route
        $response = $this->actingAs($siswaUser)->get('/admin/siswa');
        $response->assertStatus(403);
        
        // Waka routes
        $response2 = $this->actingAs($siswaUser)->get('/waka/jadwal');
        $response2->assertStatus(403);

        $response3 = $this->actingAs($siswaUser)->get('/waka/rekap-absensi');
        $response3->assertStatus(403);
    }
    
    public function test_guru_cannot_access_admin_endpoints()
    {
        $guruUser = User::where('email', 'guru@smartakademik.test')->first();

        $response = $this->actingAs($guruUser)->get('/admin/siswa');
        $response->assertStatus(403);

        $response2 = $this->actingAs($guruUser)->get('/waka/rekap-absensi');
        $response2->assertStatus(403);
    }
}

