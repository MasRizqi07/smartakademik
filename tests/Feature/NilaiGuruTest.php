<?php

namespace Tests\Feature;

use App\Livewire\Guru\NilaiGuru;
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

class NilaiGuruTest extends TestCase
{
    use RefreshDatabase;

    protected $guruUser;
    protected $guru;
    protected $kelas;
    protected $mapel;
    protected $siswa1;
    protected $siswa2;
    protected $jadwal;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndUserSeeder::class);
        
        $this->guruUser = User::where('email', 'guru@smartakademik.test')->first();
        $this->guru = Guru::where('user_id', $this->guruUser->id)->first();
        $this->kelas = Kelas::where('nama_kelas', 'X-A')->first();
        $this->mapel = Mapel::where('kode_mapel', 'MTK')->first();
        
        $this->siswa1 = Siswa::where('nisn', '0012345678')->first();
        $this->siswa2 = Siswa::create(['user_id' => null, 'nisn' => '999888', 'nama' => 'Siswa Dua', 'kelas_id' => $this->kelas->id]);
    }

    public function test_guru_can_save_nilai_formatif()
    {
        $testDate = '2023-10-10';

        Livewire::actingAs($this->guruUser)
            ->test(NilaiGuru::class)
            ->set('tanggal', $testDate)
            ->set('jenis', 'ulangan_harian')
            ->set('selectedKombinasi', $this->kelas->id . '_' . $this->mapel->id)
            ->set("nilaiData.{$this->siswa1->id}", 85.5)
            ->set("nilaiData.{$this->siswa2->id}", 90)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('nilai_formatif', [
            'siswa_id' => $this->siswa1->id,
            'mapel_id' => $this->mapel->id,
            'jenis' => 'ulangan_harian',
            'nilai' => 85.5,
            'tanggal' => $testDate . ' 00:00:00'
        ]);

        $this->assertDatabaseHas('nilai_formatif', [
            'siswa_id' => $this->siswa2->id,
            'mapel_id' => $this->mapel->id,
            'jenis' => 'ulangan_harian',
            'nilai' => 90,
            'tanggal' => $testDate . ' 00:00:00'
        ]);
    }
}
