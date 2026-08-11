<?php

namespace Tests\Feature;

use App\Livewire\Admin\JadwalManager;
use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\User;
use Database\Seeders\RoleAndUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class JadwalCRUDTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;
    protected $guru;
    protected $kelas;
    protected $mapel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndUserSeeder::class);
        $this->adminUser = User::where('email', 'admin@smartakademik.test')->first();
        
        $this->guru = Guru::create(['nip_nuptk' => 'G001', 'nama' => 'Guru A']);
        $this->kelas = Kelas::create(['tingkat' => 'X', 'nama_kelas' => 'X-A']);
        $this->mapel = Mapel::create(['kode_mapel' => 'M001', 'nama_mapel' => 'Mapel A']);
    }

    public function test_can_create_jadwal()
    {
        Livewire::actingAs($this->adminUser)
            ->test(JadwalManager::class)
            ->set('kelas_id', $this->kelas->id)
            ->set('mapel_id', $this->mapel->id)
            ->set('guru_id', $this->guru->id)
            ->set('hari', 'Senin')
            ->set('jam_ke', 1)
            ->set('waktu_mulai', '07:00')
            ->set('waktu_selesai', '08:30')
            ->call('store')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('jadwal_pelajaran', [
            'kelas_id' => $this->kelas->id,
            'guru_id' => $this->guru->id,
            'hari' => 'Senin',
            'jam_ke' => 1,
            'waktu_mulai' => '07:00', // SQLite saves as 07:00
        ]);
    }

    public function test_cannot_create_jadwal_with_guru_clash()
    {
        // Setup existing jadwal for Guru A
        $jadwal1 = JadwalPelajaran::create([
            'kelas_id' => $this->kelas->id,
            'mapel_id' => $this->mapel->id,
            'guru_id' => $this->guru->id,
            'hari' => 'Senin',
            'jam_ke' => 1,
            'waktu_mulai' => '07:00',
            'waktu_selesai' => '08:30',
        ]);
        
        $this->assertEquals(1, JadwalPelajaran::where('guru_id', $this->guru->id)->count()); // Ensure it was created

        $kelasB = Kelas::create(['tingkat' => 'X', 'nama_kelas' => 'X-B']);
        
        $livewire = Livewire::actingAs($this->adminUser)
            ->test(JadwalManager::class)
            ->set('kelas_id', $kelasB->id)
            ->set('mapel_id', $this->mapel->id)
            ->set('guru_id', $this->guru->id) // Same Guru
            ->set('hari', 'Senin')
            ->set('jam_ke', 1) // Overlaps with jam ke-1
            ->set('waktu_mulai', '07:00')
            ->set('waktu_selesai', '08:30')
            ->call('store');
            
        $livewire->assertHasErrors(['jam_ke']);
            
        $this->assertEquals(1, JadwalPelajaran::where('guru_id', $this->guru->id)->count());
    }
}
