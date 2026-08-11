<?php

namespace Tests\Feature;

use App\Livewire\Guru\AbsensiGuru;
use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\User;
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
    protected $kelas;
    protected $siswa1;
    protected $siswa2;
    protected $jadwal;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndUserSeeder::class);
        
        $this->guruUser = User::where('email', 'guru@smartakademik.test')->first();
        $this->guru = Guru::where('user_id', $this->guruUser->id)->first();
        
        $this->guru2User = User::where('email', 'guru2@smartakademik.test')->first();

        $this->kelas = Kelas::where('nama_kelas', 'X-A')->first();
        
        $this->siswa1 = Siswa::where('nisn', '0012345678')->first();
        $this->siswa2 = Siswa::create(['user_id' => null, 'nisn' => '999888', 'nama' => 'Siswa Dua', 'kelas_id' => $this->kelas->id]);

        $this->jadwal = JadwalPelajaran::where('guru_id', $this->guru->id)->first();
    }

    public function test_guru_can_see_their_own_jadwal_and_siswa()
    {
        // Act as guru 1, set date to Monday so Jadwal is loaded
        $testDate = '2023-10-09'; // A Monday
        
        // Force the app to think today is Monday for the scopeHariIni to work properly if needed
        // Or we just test that the Livewire component loads siswas correctly when jadwal is selected
        Livewire::actingAs($this->guruUser)
            ->test(AbsensiGuru::class)
            ->set('tanggal', $testDate)
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
            ->set('tanggal', $testDate)
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
}
