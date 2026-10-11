<?php

namespace Tests\Feature;

use App\Livewire\Waka\LaporanAkademik;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\NilaiFormatif;
use App\Models\Siswa;
use App\Models\User;
use Database\Seeders\RoleAndUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;
use Tests\TestCase;

class LaporanAkademikTest extends TestCase
{
    use RefreshDatabase;

    protected User $wakaUser;
    protected User $adminUser;
    protected User $guruUser;
    protected User $siswaUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndUserSeeder::class);
        $this->wakaUser = User::where('email', 'waka@smartakademik.test')->first();
        $this->adminUser = User::where('email', 'admin@smartakademik.test')->first();
        $this->guruUser = User::where('email', 'guru@smartakademik.test')->first();
        $this->siswaUser = User::where('email', 'siswa@smartakademik.test')->first();
    }

    public function test_waka_and_admin_can_access_laporan_akademik()
    {
        $this->actingAs($this->wakaUser)
            ->get(route('waka.laporan'))
            ->assertStatus(200);

        $this->actingAs($this->adminUser)
            ->get(route('admin.laporan'))
            ->assertStatus(200);

        Livewire::actingAs($this->wakaUser)
            ->test(LaporanAkademik::class)
            ->assertStatus(200);

        Livewire::actingAs($this->adminUser)
            ->test(LaporanAkademik::class)
            ->assertStatus(200);
    }

    public function test_guru_and_siswa_cannot_access_laporan_akademik()
    {
        $this->actingAs($this->guruUser)
            ->get(route('waka.laporan'))
            ->assertStatus(403);

        $this->actingAs($this->siswaUser)
            ->get(route('waka.laporan'))
            ->assertStatus(403);

        Livewire::actingAs($this->guruUser)
            ->test(LaporanAkademik::class)
            ->assertStatus(403);

        Livewire::actingAs($this->siswaUser)
            ->test(LaporanAkademik::class)
            ->assertStatus(403);
    }

    public function test_laporan_akademik_has_constant_queries_with_multiple_classes()
    {
        // Seed 10 additional classes with students
        $guru = Guru::first();
        $mapel = Mapel::first();

        for ($k = 1; $k <= 10; $k++) {
            $kelas = Kelas::create([
                'nama_kelas' => "Kelas Test {$k}",
                'tingkat' => 'X',
                'wali_kelas_id' => $guru->id,
            ]);

            for ($s = 1; $s <= 3; $s++) {
                $siswa = Siswa::create([
                    'nisn' => sprintf('999%02d%02d', $k, $s),
                    'nama' => "Siswa K{$k} S{$s}",
                    'kelas_id' => $kelas->id,
                ]);

                Absensi::create([
                    'siswa_id' => $siswa->id,
                    'jadwal_id' => 1,
                    'tanggal' => date('Y-m-d'),
                    'status' => 'hadir',
                    'dicatat_oleh' => $this->wakaUser->id,
                ]);

                NilaiFormatif::create([
                    'siswa_id' => $siswa->id,
                    'guru_id' => $guru->id,
                    'mapel_id' => $mapel->id,
                    'jenis' => 'tugas',
                    'tanggal' => date('Y-m-d'),
                    'nilai' => 80,
                ]);
            }
        }

        DB::flushQueryLog();
        DB::enableQueryLog();

        Livewire::actingAs($this->wakaUser)
            ->test(LaporanAkademik::class)
            ->assertStatus(200);

        $queries = DB::getQueryLog();
        // With 10+ classes, N+1 query loops would execute 60+ queries.
        // The aggregated batch approach must execute in <= 10 constant queries.
        $this->assertLessThanOrEqual(10, count($queries), "Query count is " . count($queries) . ", which should be constant.");
    }

    public function test_laporan_akademik_reports_truthful_aggregates_without_mock_fallbacks()
    {
        // Clear all attendance and grades to test empty state
        Absensi::query()->delete();
        NilaiFormatif::query()->delete();

        $test = Livewire::actingAs($this->wakaUser)
            ->test(LaporanAkademik::class)
            ->assertStatus(200);

        // Overall rates should be null when zero records exist, NOT fake 96.8% or 82.4
        $this->assertNull($test->viewData('overallAttendanceRate'));
        $this->assertNull($test->viewData('overallAvgGrade'));

        $reports = $test->viewData('classReports');
        $this->assertNotEmpty($reports);
        foreach ($reports as $rep) {
            $this->assertNull($rep['rate_hadir'], "Rate hadir should be null when no records exist, not fake 96.5%");
            $this->assertNull($rep['avg_nilai'], "Avg nilai should be null when no records exist, not fake 82.5");
            $this->assertEquals('Belum Ada Data', $rep['status_ketuntasan']);
        }
    }

    public function test_laporan_akademik_calculates_correct_math_when_data_exists()
    {
        Absensi::query()->delete();
        NilaiFormatif::query()->delete();

        $kelas = Kelas::first();
        $guru = Guru::first();
        $mapel = Mapel::first();

        // Class has 2 students
        $siswa1 = Siswa::create([
            'nisn' => '88880001',
            'nama' => 'Siswa Math 1',
            'kelas_id' => $kelas->id,
        ]);
        $siswa2 = Siswa::create([
            'nisn' => '88880002',
            'nama' => 'Siswa Math 2',
            'kelas_id' => $kelas->id,
        ]);

        // Student 1: hadir, Student 2: alfa => 50% attendance
        Absensi::create([
            'siswa_id' => $siswa1->id,
            'jadwal_id' => 1,
            'tanggal' => date('Y-m-d'),
            'status' => 'hadir',
            'dicatat_oleh' => $this->wakaUser->id,
        ]);
        Absensi::create([
            'siswa_id' => $siswa2->id,
            'jadwal_id' => 1,
            'tanggal' => date('Y-m-d'),
            'status' => 'alfa',
            'dicatat_oleh' => $this->wakaUser->id,
        ]);

        // Student 1: 90, Student 2: 70 => Average 80.0
        NilaiFormatif::create([
            'siswa_id' => $siswa1->id,
            'guru_id' => $guru->id,
            'mapel_id' => $mapel->id,
            'jenis' => 'tugas',
            'tanggal' => date('Y-m-d'),
            'nilai' => 90,
        ]);
        NilaiFormatif::create([
            'siswa_id' => $siswa2->id,
            'guru_id' => $guru->id,
            'mapel_id' => $mapel->id,
            'jenis' => 'tugas',
            'tanggal' => date('Y-m-d'),
            'nilai' => 70,
        ]);

        $test = Livewire::actingAs($this->wakaUser)
            ->test(LaporanAkademik::class)
            ->set('selectedKelasId', (string) $kelas->id)
            ->assertStatus(200);

        $reports = $test->viewData('classReports');
        $this->assertCount(1, $reports);
        $this->assertEquals(50.0, $reports[0]['rate_hadir']);
        $this->assertEquals(80.0, $reports[0]['avg_nilai']);
        $this->assertEquals('Tuntas', $reports[0]['status_ketuntasan']);
    }

    public function test_laporan_akademik_can_export_csv()
    {
        $component = new LaporanAkademik();
        $this->actingAs($this->wakaUser);

        $response = $component->exportCsv();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('text/csv; charset=UTF-8', $response->headers->get('Content-Type'));
        $this->assertStringContainsString('attachment; filename="laporan-akademik-man4jombang-', $response->headers->get('Content-Disposition'));

        ob_start();
        $response->sendContent();
        $content = ob_get_clean();

        $this->assertStringContainsString('LAPORAN ANALITIK AKADEMIK & PRESENSI MAN 4 JOMBANG', $content);
        $this->assertStringContainsString('Rata-rata Presensi (%)', $content);
        $this->assertStringContainsString('Rata-rata Nilai Formatif', $content);
        $this->assertStringContainsString('Ketuntasan KKM (%)', $content);
    }
}
