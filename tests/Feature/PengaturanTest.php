<?php

namespace Tests\Feature;

use App\Livewire\Admin\PengaturanManager;
use App\Models\PengaturanAkademik;
use App\Models\User;
use Database\Seeders\RoleAndUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PengaturanTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndUserSeeder::class);
        $this->adminUser = User::where('email', 'admin@smartakademik.test')->first();
    }

    public function test_pengaturan_persists_across_fresh_component_instance()
    {
        Livewire::actingAs($this->adminUser)
            ->test(PengaturanManager::class)
            ->set('namaMadrasah', 'MAN 4 Jombang (Updated)')
            ->set('kkmDefault', 80)
            ->call('saveSettings');

        $this->assertDatabaseHas('pengaturan_akademik', [
            'nama_madrasah' => 'MAN 4 Jombang (Updated)',
            'kkm_default' => 80,
        ]);

        // Fresh component instance: verify values are loaded via mount()
        Livewire::actingAs($this->adminUser)
            ->test(PengaturanManager::class)
            ->assertSet('namaMadrasah', 'MAN 4 Jombang (Updated)')
            ->assertSet('kkmDefault', 80);
    }

    public function test_pengaturan_can_update_semester_and_kbm_duration()
    {
        Livewire::actingAs($this->adminUser)
            ->test(PengaturanManager::class)
            ->set('semesterAktif', 'Genap')
            ->set('durasiJamKbm', 40)
            ->call('saveSettings');

        $this->assertDatabaseHas('pengaturan_akademik', [
            'semester_aktif' => 'Genap',
            'durasi_jam_kbm' => 40,
        ]);

        Livewire::actingAs($this->adminUser)
            ->test(PengaturanManager::class)
            ->assertSet('semesterAktif', 'Genap')
            ->assertSet('durasiJamKbm', 40);
    }
}
