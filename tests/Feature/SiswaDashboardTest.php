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
}
