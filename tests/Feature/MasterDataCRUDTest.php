<?php

namespace Tests\Feature;

use App\Livewire\Admin\SiswaManager;
use App\Livewire\Admin\GuruManager;
use App\Livewire\Admin\KelasManager;
use App\Livewire\Admin\MapelManager;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\User;
use Database\Seeders\RoleAndUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class MasterDataCRUDTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndUserSeeder::class);
        $this->adminUser = User::where('email', 'admin@smartakademik.test')->first();
    }

    public function test_can_create_mapel()
    {
        Livewire::actingAs($this->adminUser)
            ->test(MapelManager::class)
            ->set('kode_mapel', 'FIS')
            ->set('nama_mapel', 'Fisika')
            ->call('store');

        $this->assertDatabaseHas('mapel', [
            'kode_mapel' => 'FIS',
            'nama_mapel' => 'Fisika',
        ]);
    }

    public function test_can_create_kelas()
    {
        Livewire::actingAs($this->adminUser)
            ->test(KelasManager::class)
            ->set('tingkat', 'XI')
            ->set('nama_kelas', 'XI-IPA-1')
            ->call('store');

        $this->assertDatabaseHas('kelas', [
            'tingkat' => 'XI',
            'nama_kelas' => 'XI-IPA-1',
        ]);
    }

    public function test_can_create_guru()
    {
        Livewire::actingAs($this->adminUser)
            ->test(GuruManager::class)
            ->set('nip_nuptk', '1234567890')
            ->set('nama', 'Pak Joko')
            ->call('store');

        $this->assertDatabaseHas('guru', [
            'nip_nuptk' => '1234567890',
            'nama' => 'Pak Joko',
        ]);
    }

    public function test_can_create_siswa_with_user_account()
    {
        $kelas = Kelas::first();

        Livewire::actingAs($this->adminUser)
            ->test(SiswaManager::class)
            ->set('nisn', '999888777')
            ->set('nama', 'Anak Baru')
            ->set('kelas_id', $kelas->id)
            ->set('create_user_account', true)
            ->set('email', 'anakbaru@test.com')
            ->call('store');

        $this->assertDatabaseHas('siswa', [
            'nisn' => '999888777',
            'nama' => 'Anak Baru',
            'kelas_id' => $kelas->id,
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'anakbaru@test.com',
            'name' => 'Anak Baru',
        ]);
    }
}
