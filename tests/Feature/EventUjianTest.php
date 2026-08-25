<?php

namespace Tests\Feature;

use App\Livewire\Admin\EventUjianManager;
use App\Models\EventUjian;
use App\Models\User;
use Database\Seeders\RoleAndUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EventUjianTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndUserSeeder::class);
        $this->adminUser = User::where('email', 'admin@smartakademik.test')->first();
    }

    public function test_event_ujian_persists_across_fresh_component_instance()
    {
        Livewire::actingAs($this->adminUser)
            ->test(EventUjianManager::class)
            ->set('namaUjian', 'Ujian Persistence Check')
            ->set('jenisUjian', 'PTS Ganjil')
            ->set('tanggalUjian', '2026-09-20')
            ->set('waktuUjian', '07:30 - 09:30')
            ->set('ruangan', 'Ruang Test')
            ->set('pengawasNama', 'Ahmad Fauzi, S.Pd.')
            ->call('saveEvent');

        $this->assertDatabaseHas('event_ujian', [
            'nama' => 'Ujian Persistence Check',
            'ruangan' => 'Ruang Test',
            'peserta' => null,
            'status' => 'Terjadwal',
        ]);

        // Fresh component instance: verify data is rendered from database
        Livewire::actingAs($this->adminUser)
            ->test(EventUjianManager::class)
            ->assertSee('Ujian Persistence Check')
            ->assertSee('Ruang Test');
    }

    public function test_delete_event_ujian_removes_from_database()
    {
        $event = EventUjian::create([
            'nama' => 'Event To Delete',
            'jenis' => 'PAS Ganjil',
            'tanggal' => '2026-12-01',
            'waktu' => '08:00 - 10:00',
            'ruangan' => 'Lab Komputer',
            'pengawas_nama' => 'Budi Santoso, S.Kom.',
            'peserta' => null,
            'status' => 'Terjadwal',
        ]);

        $this->assertDatabaseHas('event_ujian', ['id' => $event->id]);

        Livewire::actingAs($this->adminUser)
            ->test(EventUjianManager::class)
            ->call('deleteEvent', $event->id);

        $this->assertDatabaseMissing('event_ujian', ['id' => $event->id]);
    }

    public function test_filter_and_search_event_ujian()
    {
        EventUjian::create([
            'nama' => 'Matematika Peminatan',
            'jenis' => 'PTS Ganjil',
            'tanggal' => '2026-09-15',
            'waktu' => '07:30 - 09:30',
            'ruangan' => 'Ruang 01',
            'pengawas_nama' => 'Guru A',
            'peserta' => null,
            'status' => 'Terjadwal',
        ]);

        EventUjian::create([
            'nama' => 'Fisika Terapan',
            'jenis' => 'PAS Ganjil',
            'tanggal' => '2026-12-05',
            'waktu' => '08:00 - 10:00',
            'ruangan' => 'Lab Fisika',
            'pengawas_nama' => 'Guru B',
            'peserta' => null,
            'status' => 'Terjadwal',
        ]);

        // Search by name
        Livewire::actingAs($this->adminUser)
            ->test(EventUjianManager::class)
            ->set('search', 'Fisika')
            ->assertSee('Fisika Terapan')
            ->assertDontSee('Matematika Peminatan');

        // Filter by jenis
        Livewire::actingAs($this->adminUser)
            ->test(EventUjianManager::class)
            ->set('filterJenis', 'PTS Ganjil')
            ->assertSee('Matematika Peminatan')
            ->assertDontSee('Fisika Terapan');
    }
}
