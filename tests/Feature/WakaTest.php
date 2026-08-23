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

    public function test_rekap_absensi_has_constant_queries_with_multiple_students()
    {
        $kelas = \App\Models\Kelas::first();
        for ($i = 1; $i <= 15; $i++) {
            $siswa = \App\Models\Siswa::create([
                'nisn' => '001000' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'nama' => "Siswa Test {$i}",
                'kelas_id' => $kelas->id,
            ]);

            \App\Models\Absensi::create([
                'siswa_id' => $siswa->id,
                'jadwal_id' => 1,
                'tanggal' => date('Y-m-d'),
                'status' => 'hadir',
                'dicatat_oleh' => $this->wakaUser->id,
            ]);
        }

        \Illuminate\Support\Facades\DB::flushQueryLog();
        \Illuminate\Support\Facades\DB::enableQueryLog();

        Livewire::actingAs($this->wakaUser)
            ->test(RekapAbsensi::class)
            ->assertStatus(200);

        $queries = \Illuminate\Support\Facades\DB::getQueryLog();
        // With 15 students, N+1 would execute 15+ queries. The collapsed query runs in <= 5 queries.
        $this->assertLessThanOrEqual(6, count($queries), "Query count is " . count($queries) . ", which should be constant.");
    }

    public function test_rekap_nilai_has_constant_queries_with_multiple_students()
    {
        $kelas = \App\Models\Kelas::first();
        $mapel = \App\Models\Mapel::first();
        $guru = \App\Models\Guru::first();

        for ($i = 1; $i <= 15; $i++) {
            $siswa = \App\Models\Siswa::create([
                'nisn' => '002000' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'nama' => "Siswa Nilai {$i}",
                'kelas_id' => $kelas->id,
            ]);

            \App\Models\NilaiFormatif::create([
                'siswa_id' => $siswa->id,
                'guru_id' => $guru->id,
                'mapel_id' => $mapel->id,
                'jenis' => 'tugas',
                'tanggal' => date('Y-m-d'),
                'nilai' => 85,
            ]);
        }

        \Illuminate\Support\Facades\DB::flushQueryLog();
        \Illuminate\Support\Facades\DB::enableQueryLog();

        Livewire::actingAs($this->wakaUser)
            ->test(RekapNilai::class)
            ->assertStatus(200);

        $queries = \Illuminate\Support\Facades\DB::getQueryLog();
        // With 15 students, N+1 would execute 15+ queries. The collapsed queries run in <= 6 queries.
        $this->assertLessThanOrEqual(7, count($queries), "Query count is " . count($queries) . ", which should be constant.");
    }

    public function test_waka_can_export_rekap_absensi_csv()
    {
        $kelas = \App\Models\Kelas::first();
        $siswa = \App\Models\Siswa::create([
            'nisn' => '0010009999',
            'nama' => "Siswa Export Test",
            'kelas_id' => $kelas->id,
        ]);

        $response = Livewire::actingAs($this->wakaUser)
            ->test(RekapAbsensi::class)
            ->call('exportCsv');

        $response->assertFileDownloaded();
    }
}

