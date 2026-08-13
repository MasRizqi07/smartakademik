<?php

namespace Tests\Feature;

use App\Livewire\Waka\JadwalManager;
use App\Livewire\Waka\RekapAbsensi;
use App\Livewire\Waka\RekapNilai;
use App\Models\User;
use Database\Seeders\RoleAndUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class WakaTest extends TestCase
{
    use RefreshDatabase;

    protected $wakaUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndUserSeeder::class);
        $this->wakaUser = User::where('email', 'waka@smartakademik.test')->first();
    }

    public function test_waka_can_access_jadwal_manager()
    {
        $response = $this->actingAs($this->wakaUser)->get(route('waka.jadwal'));
        $response->assertStatus(200);

        Livewire::actingAs($this->wakaUser)
            ->test(JadwalManager::class)
            ->assertStatus(200);
    }

    public function test_waka_can_access_rekap_absensi()
    {
        $response = $this->actingAs($this->wakaUser)->get(route('waka.rekap-absensi'));
        $response->assertStatus(200);

        Livewire::actingAs($this->wakaUser)
            ->test(RekapAbsensi::class)
            ->assertStatus(200);
    }

    public function test_waka_can_access_rekap_nilai()
    {
        $response = $this->actingAs($this->wakaUser)->get(route('waka.rekap-nilai'));
        $response->assertStatus(200);

        Livewire::actingAs($this->wakaUser)
            ->test(RekapNilai::class)
            ->assertStatus(200);
    }
}
