<?php

namespace Tests\Feature;

use App\Livewire\Guru\ProfilGuru;
use App\Models\Absensi;
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

class DashboardMetricsTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;
    protected $guruUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndUserSeeder::class);
        $this->adminUser = User::where('email', 'admin@smartakademik.test')->first();
        $this->guruUser = User::where('email', 'guru@smartakademik.test')->first();
    }

    public function test_admin_dashboard_renders_computed_attendance_rate_and_no_fabricated_literals()
    {
        // 1. Empty absensi state
        $responseEmpty = $this->actingAs($this->adminUser)->get(route('admin.dashboard'));
        $responseEmpty->assertStatus(200);
        $responseEmpty->assertSee('-');
        $responseEmpty->assertDontSee('96.8%');
        $responseEmpty->assertDontSee('+1.2% dari minggu lalu');

        // 2. Seeded absensi: 9 hadir, 1 alfa = 90.0%
        $kelas = Kelas::first();
        $siswa = Siswa::first();
        for ($i = 1; $i <= 9; $i++) {
            Absensi::create([
                'siswa_id' => $siswa->id,
                'jadwal_id' => 1,
                'tanggal' => "2026-08-" . sprintf('%02d', $i),
                'status' => 'hadir',
                'dicatat_oleh' => $this->adminUser->id,
            ]);
        }
        Absensi::create([
            'siswa_id' => $siswa->id,
            'jadwal_id' => 1,
            'tanggal' => '2026-08-10',
            'status' => 'alfa',
            'dicatat_oleh' => $this->adminUser->id,
        ]);

        $responseSeeded = $this->actingAs($this->adminUser)->get(route('admin.dashboard'));
        $responseSeeded->assertStatus(200);
        $responseSeeded->assertSee('90.0%');
        $responseSeeded->assertDontSee('96.8%');
        $responseSeeded->assertDontSee('+1.2% dari minggu lalu');
    }

    public function test_guru_dashboard_renders_computed_metrics_and_no_fabricated_literals()
    {
        $guru = $this->guruUser->guru;
        $kelas1 = Kelas::create(['nama_kelas' => 'XII-MIPA-1', 'tingkat' => 'XII']);
        $kelas2 = Kelas::create(['nama_kelas' => 'XII-MIPA-2', 'tingkat' => 'XII']);
        $mapel = Mapel::first();

        // Seed 2 distinct classes for this guru on Kamis (avoiding existing Monday schedule)
        JadwalPelajaran::create([
            'guru_id' => $guru->id,
            'kelas_id' => $kelas1->id,
            'mapel_id' => $mapel->id,
            'hari' => 'Kamis',
            'jam_ke' => 3,
            'waktu_mulai' => '09:00',
            'waktu_selesai' => '10:30',
        ]);
        JadwalPelajaran::create([
            'guru_id' => $guru->id,
            'kelas_id' => $kelas2->id,
            'mapel_id' => $mapel->id,
            'hari' => 'Kamis',
            'jam_ke' => 4,
            'waktu_mulai' => '10:30',
            'waktu_selesai' => '12:00',
        ]);

        $response = $this->actingAs($this->guruUser)->get(route('guru.dashboard'));
        $response->assertStatus(200);

        // Expected computed values
        $response->assertSee('Kelas');

        // G7 dashes for ambiguous metrics
        $response->assertSee('Siswa Belum Formatif');
        $response->assertSee('KBM per Minggu');

        // Old fabricated literals MUST NOT be present
        $response->assertDontSee('<p class="font-headline-lg text-2xl font-bold text-text-main">12</p>', false);
        $response->assertDontSee('24 Jam');
    }

    public function test_profil_guru_renders_computed_metrics_and_no_fabricated_literals()
    {
        $guru = $this->guruUser->guru;
        $kelas = Kelas::create(['nama_kelas' => 'XI-AGAMA', 'tingkat' => 'XI']);
        $mapel = Mapel::first();

        // Count existing schedules for this guru
        $existingCount = JadwalPelajaran::where('guru_id', $guru->id)->count();

        // Seed 2 additional schedules for this guru on Jumat & Sabtu
        JadwalPelajaran::create([
            'guru_id' => $guru->id,
            'kelas_id' => $kelas->id,
            'mapel_id' => $mapel->id,
            'hari' => 'Jumat',
            'jam_ke' => 1,
            'waktu_mulai' => '07:00',
            'waktu_selesai' => '08:30',
        ]);
        JadwalPelajaran::create([
            'guru_id' => $guru->id,
            'kelas_id' => $kelas->id,
            'mapel_id' => $mapel->id,
            'hari' => 'Sabtu',
            'jam_ke' => 2,
            'waktu_mulai' => '08:30',
            'waktu_selesai' => '10:00',
        ]);

        $expectedRombel = $existingCount + 2;

        Livewire::actingAs($this->guruUser)
            ->test(ProfilGuru::class)
            ->assertSee("{$expectedRombel} <span class=\"text-xs font-normal text-outline\">Rombel</span>", false)
            ->assertSee('- <span class="text-xs font-normal text-outline">Jam / Minggu</span>', false)
            ->assertDontSee('24 <span class="text-xs font-normal text-outline">Jam / Minggu</span>', false);
    }
}
