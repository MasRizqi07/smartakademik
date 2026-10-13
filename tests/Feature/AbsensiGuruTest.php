<?php

namespace Tests\Feature;

use App\Livewire\Guru\AbsensiGuru;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\RoleAndUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AbsensiGuruTest extends TestCase
{
    use RefreshDatabase;

    protected $guruUser;
    protected $guru2User;
    protected $guru;
    protected $guru2;
    protected $kelas;
    protected $siswa1;
    protected $siswa2;
    protected $jadwal;

    protected function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow('2023-10-09 08:00:00');
        $this->seed(RoleAndUserSeeder::class);
        
        $this->guruUser = User::where('email', 'guru@smartakademik.test')->first();
        $this->guru = Guru::where('user_id', $this->guruUser->id)->first();
        
        $this->guru2User = User::where('email', 'guru2@smartakademik.test')->first();
        $this->guru2 = Guru::where('user_id', $this->guru2User->id)->first();

        $this->kelas = Kelas::where('nama_kelas', 'X-A')->first();
        
        $this->siswa1 = Siswa::where('nisn', '0012345678')->first();
        $this->siswa2 = Siswa::create(['user_id' => null, 'nisn' => '999888', 'nama' => 'Siswa Dua', 'kelas_id' => $this->kelas->id]);

        $this->jadwal = JadwalPelajaran::where('guru_id', $this->guru->id)->first();
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_guru_can_see_their_own_jadwal_and_siswa()
    {
        $testDate = '2023-10-09';
        
        Livewire::actingAs($this->guruUser)
            ->test(AbsensiGuru::class)
            ->set('selectedJadwalId', $this->jadwal->id)
            ->assertCount('siswas', 2)
            ->assertSee($this->siswa1->nama)
            ->assertSee($this->siswa2->nama);
    }

    public function test_guru_can_save_absensi()
    {
        $testDate = '2023-10-09';

        Livewire::actingAs($this->guruUser)
            ->test(AbsensiGuru::class)
            ->set('selectedJadwalId', $this->jadwal->id)
            ->set("absensiData.{$this->siswa1->id}", 'hadir')
            ->set("absensiData.{$this->siswa2->id}", 'sakit')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('absensi', [
            'siswa_id' => $this->siswa1->id,
            'jadwal_id' => $this->jadwal->id,
            'tanggal' => $testDate . ' 00:00:00',
            'status' => 'hadir'
        ]);

        $this->assertDatabaseHas('absensi', [
            'siswa_id' => $this->siswa2->id,
            'jadwal_id' => $this->jadwal->id,
            'tanggal' => $testDate . ' 00:00:00',
            'status' => 'sakit'
        ]);
    }

    public function test_method_level_guard_denies_non_owner_direct_mutation()
    {
        $testDate = '2023-10-09';

        // 1. setPresence direct call
        Livewire::actingAs($this->guru2User)
            ->test(AbsensiGuru::class, [
                'selectedJadwalId' => $this->jadwal->id,
            ])
            ->call('setPresence', $this->siswa1->id, 'hadir')
            ->assertForbidden();

        $this->assertDatabaseMissing('absensi', [
            'jadwal_id' => $this->jadwal->id,
            'siswa_id' => $this->siswa1->id,
        ]);

        // 2. resetAll direct call
        Livewire::actingAs($this->guru2User)
            ->test(AbsensiGuru::class, [
                'selectedJadwalId' => $this->jadwal->id,
            ])
            ->call('resetAll')
            ->assertForbidden();

        // 3. saveNote direct call
        Livewire::actingAs($this->guru2User)
            ->test(AbsensiGuru::class, [
                'selectedJadwalId' => $this->jadwal->id,
            ])
            ->set('activeSiswaId', $this->siswa1->id)
            ->set('noteText', 'Catatan terlarang')
            ->call('saveNote')
            ->assertForbidden();
    }

    public function test_set_presence_rejects_invalid_status()
    {
        $testDate = '2023-10-09';

        Livewire::actingAs($this->guruUser)
            ->test(AbsensiGuru::class)
            ->set('selectedJadwalId', $this->jadwal->id)
            ->call('setPresence', $this->siswa1->id, 'bolos')
            ->assertStatus(422);

        $this->assertDatabaseMissing('absensi', [
            'jadwal_id' => $this->jadwal->id,
            'siswa_id' => $this->siswa1->id,
        ]);
    }

    public function test_set_presence_rejects_student_from_different_class()
    {
        $testDate = '2023-10-09';
        $otherKelas = Kelas::create(['tingkat' => 'XI', 'nama_kelas' => 'XI-B']);
        $otherSiswa = Siswa::create(['nisn' => '777666', 'nama' => 'Siswa Luar', 'kelas_id' => $otherKelas->id]);

        Livewire::actingAs($this->guruUser)
            ->test(AbsensiGuru::class)
            ->set('selectedJadwalId', $this->jadwal->id)
            ->call('setPresence', $otherSiswa->id, 'hadir')
            ->assertStatus(404);

        $this->assertDatabaseMissing('absensi', [
            'jadwal_id' => $this->jadwal->id,
            'siswa_id' => $otherSiswa->id,
        ]);
    }

    public function test_mark_all_hadir_is_local_state_only_and_preserves_existing_status()
    {
        $testDate = '2023-10-09';

        // Pre-create an 'izin' row for siswa1
        Absensi::create([
            'siswa_id' => $this->siswa1->id,
            'jadwal_id' => $this->jadwal->id,
            'tanggal' => $testDate,
            'status' => 'izin',
            'dicatat_oleh' => $this->guruUser->id,
        ]);

        $initialRowCount = Absensi::count();

        $component = Livewire::actingAs($this->guruUser)
            ->test(AbsensiGuru::class)
            ->set('selectedJadwalId', $this->jadwal->id);

        // Verify siswa1 is loaded as izin
        $this->assertEquals('izin', $component->get('absensiData')[$this->siswa1->id]);
        $this->assertNull($component->get('absensiData')[$this->siswa2->id]);

        // Call markAllHadir
        $component->call('markAllHadir');

        // Assert local state: siswa1 remains izin, siswa2 filled as hadir
        $absensiData = $component->get('absensiData');
        $this->assertEquals('izin', $absensiData[$this->siswa1->id]);
        $this->assertEquals('hadir', $absensiData[$this->siswa2->id]);

        // Assert DB state is UNCHANGED immediately after markAllHadir
        $this->assertEquals($initialRowCount, Absensi::count());
        $this->assertDatabaseHas('absensi', [
            'siswa_id' => $this->siswa1->id,
            'jadwal_id' => $this->jadwal->id,
            'status' => 'izin',
        ]);
        $this->assertDatabaseMissing('absensi', [
            'siswa_id' => $this->siswa2->id,
            'jadwal_id' => $this->jadwal->id,
        ]);

        // Now call save() and assert all rows persist
        $component->call('save')->assertHasNoErrors();

        $this->assertDatabaseHas('absensi', [
            'siswa_id' => $this->siswa1->id,
            'jadwal_id' => $this->jadwal->id,
            'status' => 'izin',
        ]);
        $this->assertDatabaseHas('absensi', [
            'siswa_id' => $this->siswa2->id,
            'jadwal_id' => $this->jadwal->id,
            'status' => 'hadir',
        ]);
    }

    public function test_reset_all_and_save_note_by_non_owner_forbidden()
    {
        $testDate = '2023-10-09';
        Absensi::create([
            'siswa_id' => $this->siswa1->id,
            'jadwal_id' => $this->jadwal->id,
            'tanggal' => $testDate,
            'status' => 'hadir',
            'keterangan' => 'Asli',
            'dicatat_oleh' => $this->guruUser->id,
        ]);

        Livewire::actingAs($this->guru2User)
            ->test(AbsensiGuru::class, [
                'selectedJadwalId' => $this->jadwal->id,
            ])
            ->set('activeSiswaId', $this->siswa1->id)
            ->set('noteText', 'Ubah keterangan')
            ->call('saveNote')
            ->assertForbidden();

        Livewire::actingAs($this->guru2User)
            ->test(AbsensiGuru::class, [
                'selectedJadwalId' => $this->jadwal->id,
            ])
            ->call('resetAll')
            ->assertForbidden();

        // Row still exists intact
        $this->assertDatabaseHas('absensi', [
            'siswa_id' => $this->siswa1->id,
            'jadwal_id' => $this->jadwal->id,
            'status' => 'hadir',
            'keterangan' => 'Asli',
        ]);
    }

    public function test_guru_with_no_guru_record_sees_empty_jadwal_list()
    {
        $userWithoutGuru = User::factory()->create();
        $userWithoutGuru->assignRole('guru');

        Livewire::actingAs($userWithoutGuru)
            ->test(AbsensiGuru::class)
            ->assertCount('jadwals', 0);
    }

    public function test_save_aborts_with_422_when_status_is_not_whitelisted()
    {
        $testDate = '2023-10-09';

        Livewire::actingAs($this->guruUser)
            ->test(AbsensiGuru::class, [
                'selectedJadwalId' => $this->jadwal->id,
            ])
            ->set("absensiData.{$this->siswa1->id}", 'hadir')
            ->set("absensiData.{$this->siswa2->id}", 'bolos')
            ->call('save')
            ->assertStatus(422);

        $this->assertEquals(0, Absensi::where('jadwal_id', $this->jadwal->id)->whereDate('tanggal', $testDate)->count());
    }

    public function test_tanggal_is_forced_to_today_on_mount()
    {
        Carbon::setTestNow('2023-10-09 08:00:00');

        Livewire::actingAs($this->guruUser)
            ->test(AbsensiGuru::class)
            ->assertSet('tanggal', '2023-10-09');

        Livewire::actingAs($this->guruUser)
            ->test(AbsensiGuru::class, ['tanggal' => '2023-10-15'])
            ->assertSet('tanggal', '2023-10-09');
    }

    public function test_tanggal_cannot_be_modified_from_client()
    {
        $this->expectException(\Livewire\Features\SupportLockedProperties\CannotUpdateLockedPropertyException::class);

        Livewire::actingAs($this->guruUser)
            ->test(AbsensiGuru::class)
            ->set('tanggal', '2023-10-10');
    }

    public function test_writes_are_rejected_after_day_rollover()
    {
        $mountAtRollover = function () {
            Carbon::setTestNow(Carbon::parse('2023-10-09 23:55:00', 'Asia/Jakarta'));
            $comp = Livewire::actingAs($this->guruUser)
                ->test(AbsensiGuru::class, [
                    'selectedJadwalId' => $this->jadwal->id,
                ]);
            $comp->assertSet('tanggal', '2023-10-09');
            Carbon::setTestNow(Carbon::parse('2023-10-10 00:05:00', 'Asia/Jakarta'));
            return $comp;
        };

        // 1. setPresence
        $mountAtRollover()->call('setPresence', $this->siswa1->id, 'hadir')
            ->assertStatus(422);

        // 2. markAllHadir
        $mountAtRollover()->call('markAllHadir')
            ->assertStatus(422);

        // 3. resetAll
        $mountAtRollover()->call('resetAll')
            ->assertStatus(422);

        // 4. saveNote
        $mountAtRollover()
            ->set('activeSiswaId', $this->siswa1->id)
            ->set('noteText', 'Catatan rollover')
            ->call('saveNote')
            ->assertStatus(422);

        // 5. save
        $mountAtRollover()
            ->set("absensiData.{$this->siswa1->id}", 'hadir')
            ->set("absensiData.{$this->siswa2->id}", 'hadir')
            ->call('save')
            ->assertStatus(422);

        $this->assertSame(0, Absensi::count());
    }
}
