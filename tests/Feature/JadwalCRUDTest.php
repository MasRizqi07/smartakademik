<?php

namespace Tests\Feature;

use App\Livewire\Admin\JadwalManager;
use App\Livewire\Waka\JadwalManager as WakaJadwalManager;
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

    public function test_guru_cannot_mutate_jadwal_on_waka_jadwal_manager()
    {
        $guruUser = User::where('email', 'guru@smartakademik.test')->first();
        
        $existingJadwal = JadwalPelajaran::create([
            'kelas_id' => $this->kelas->id,
            'mapel_id' => $this->mapel->id,
            'guru_id' => $this->guru->id,
            'hari' => 'Rabu',
            'jam_ke' => 4,
            'waktu_mulai' => '10:00',
            'waktu_selesai' => '11:30',
        ]);

        $initialCount = JadwalPelajaran::count();

        // 1. Guru calling create gets 403
        Livewire::actingAs($guruUser)
            ->test(WakaJadwalManager::class)
            ->call('create')
            ->assertForbidden();

        // 2. Guru calling edit gets 403
        Livewire::actingAs($guruUser)
            ->test(WakaJadwalManager::class)
            ->call('edit', $existingJadwal->id)
            ->assertForbidden();

        // 3. Guru calling store gets 403
        Livewire::actingAs($guruUser)
            ->test(WakaJadwalManager::class)
            ->set('kelas_id', $this->kelas->id)
            ->set('mapel_id', $this->mapel->id)
            ->set('guru_id', $this->guru->id)
            ->set('hari', 'Kamis')
            ->set('jam_ke', 2)
            ->set('waktu_mulai', '08:00')
            ->set('waktu_selesai', '09:30')
            ->call('store')
            ->assertForbidden();

        $this->assertEquals($initialCount, JadwalPelajaran::count());

        // 4. Guru calling delete gets 403
        Livewire::actingAs($guruUser)
            ->test(WakaJadwalManager::class)
            ->call('delete', $existingJadwal->id)
            ->assertForbidden();

        $this->assertDatabaseHas('jadwal_pelajaran', ['id' => $existingJadwal->id]);
    }

    public function test_waka_and_admin_can_manage_jadwal_on_waka_jadwal_manager()
    {
        $wakaUser = User::where('email', 'waka@smartakademik.test')->first();

        // Waka can create/store
        Livewire::actingAs($wakaUser)
            ->test(WakaJadwalManager::class)
            ->set('kelas_id', $this->kelas->id)
            ->set('mapel_id', $this->mapel->id)
            ->set('guru_id', $this->guru->id)
            ->set('hari', 'Jumat')
            ->set('jam_ke', 1)
            ->set('waktu_mulai', '07:00')
            ->set('waktu_selesai', '08:00')
            ->call('store')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('jadwal_pelajaran', [
            'hari' => 'Jumat',
            'jam_ke' => 1,
            'guru_id' => $this->guru->id,
        ]);

        // Admin can also manage
        $jadwal = JadwalPelajaran::where('hari', 'Jumat')->first();
        Livewire::actingAs($this->adminUser)
            ->test(WakaJadwalManager::class)
            ->call('edit', $jadwal->id)
            ->assertHasNoErrors()
            ->call('delete', $jadwal->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('jadwal_pelajaran', ['id' => $jadwal->id]);
    }
}
