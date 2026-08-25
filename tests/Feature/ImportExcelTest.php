<?php

namespace Tests\Feature;

use App\Imports\GuruImport;
use App\Imports\KelasImport;
use App\Imports\MapelImport;
use App\Imports\SiswaImport;
use App\Livewire\Admin\ImportExcel;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\User;
use Database\Seeders\RoleAndUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ImportExcelTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndUserSeeder::class);
        $this->adminUser = User::where('email', 'admin@smartakademik.test')->first();
    }

    public function test_can_download_templates()
    {
        Livewire::actingAs($this->adminUser)
            ->test(ImportExcel::class)
            ->set('type', 'siswa')
            ->call('downloadTemplate')
            ->assertFileDownloaded('template_import_siswa.csv');

        Livewire::actingAs($this->adminUser)
            ->test(ImportExcel::class)
            ->set('type', 'guru')
            ->call('downloadTemplate')
            ->assertFileDownloaded('template_import_guru.csv');

        Livewire::actingAs($this->adminUser)
            ->test(ImportExcel::class)
            ->set('type', 'kelas')
            ->call('downloadTemplate')
            ->assertFileDownloaded('template_import_kelas.csv');

        Livewire::actingAs($this->adminUser)
            ->test(ImportExcel::class)
            ->set('type', 'mapel')
            ->call('downloadTemplate')
            ->assertFileDownloaded('template_import_mapel.csv');
    }

    public function test_siswa_import_logic()
    {
        $file = UploadedFile::fake()->createWithContent('siswa.csv', "nisn,nama,tingkat,nama_kelas\n0099887766,Budi Import,X,X-A");
        
        Excel::import(new SiswaImport, $file);

        $this->assertDatabaseHas('siswa', [
            'nisn' => '0099887766',
            'nama' => 'Budi Import',
        ]);

        $siswa = Siswa::where('nisn', '0099887766')->first();
        $this->assertNotNull($siswa->user_id);

        $user = User::find($siswa->user_id);
        $this->assertNotNull($user);
        $this->assertEquals('0099887766@siswa.smartakademik.local', $user->email);
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('0099887766', $user->password));
        $this->assertTrue((bool) $user->must_change_password);
        $this->assertTrue($user->hasRole('siswa'));
    }

    public function test_retroactive_siswa_user_account_provisioning()
    {
        $kelas = Kelas::where('nama_kelas', 'X-A')->first();
        $unprovisionedSiswa = Siswa::create([
            'nisn' => '1122334455',
            'nama' => 'Siswa Unprovisioned',
            'kelas_id' => $kelas->id,
            'user_id' => null,
        ]);

        $this->assertNull($unprovisionedSiswa->user_id);

        // Retroactive single creation via SiswaManager
        Livewire::actingAs($this->adminUser)
            ->test(\App\Livewire\Admin\SiswaManager::class)
            ->call('createUserAccount', $unprovisionedSiswa->id)
            ->assertHasNoErrors();

        $unprovisionedSiswa->refresh();
        $this->assertNotNull($unprovisionedSiswa->user_id);

        $user = User::find($unprovisionedSiswa->user_id);
        $this->assertEquals('1122334455@siswa.smartakademik.local', $user->email);
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('1122334455', $user->password));
        $this->assertTrue((bool) $user->must_change_password);
        $this->assertTrue($user->hasRole('siswa'));

        // Retroactive bulk generation via SiswaManager
        $siswa2 = Siswa::create([
            'nisn' => '9988776655',
            'nama' => 'Siswa Bulk Unprovisioned',
            'kelas_id' => $kelas->id,
            'user_id' => null,
        ]);

        Livewire::actingAs($this->adminUser)
            ->test(\App\Livewire\Admin\SiswaManager::class)
            ->call('generateMissingAccounts')
            ->assertHasNoErrors();

        $siswa2->refresh();
        $this->assertNotNull($siswa2->user_id);
        $user2 = User::find($siswa2->user_id);
        $this->assertEquals('9988776655@siswa.smartakademik.local', $user2->email);
        $this->assertTrue($user2->hasRole('siswa'));
    }

    public function test_guru_import_logic()
    {
        $file = UploadedFile::fake()->createWithContent('guru.csv', "nip_nuptk,nama,email\n199988776655,Guru Import,guruimport@smartakademik.test");
        
        Excel::import(new GuruImport, $file);

        $this->assertDatabaseHas('guru', [
            'nip_nuptk' => '199988776655',
            'nama' => 'Guru Import',
        ]);
        $this->assertDatabaseHas('users', [
            'email' => 'guruimport@smartakademik.test',
        ]);
    }

    public function test_kelas_import_logic()
    {
        $file = UploadedFile::fake()->createWithContent('kelas.csv', "nama_kelas,tingkat\nXI-IPA-1,XI");
        
        Excel::import(new KelasImport, $file);

        $this->assertDatabaseHas('kelas', [
            'nama_kelas' => 'XI-IPA-1',
            'tingkat' => 'XI',
        ]);
    }

    public function test_mapel_import_logic()
    {
        $file = UploadedFile::fake()->createWithContent('mapel.csv', "kode_mapel,nama_mapel\nFIS,Fisika");
        
        Excel::import(new MapelImport, $file);

        $this->assertDatabaseHas('mapel', [
            'kode_mapel' => 'FIS',
            'nama_mapel' => 'Fisika',
        ]);
    }

    public function test_import_excel_component_handles_validation_failures_gracefully()
    {
        // File with invalid rows (missing NISN on row 2)
        $invalidContent = "nisn,nama,tingkat,nama_kelas\n,Siswa Tanpa NISN,X,X-A";
        $file = UploadedFile::fake()->createWithContent('invalid_siswa.csv', $invalidContent);

        $test = Livewire::actingAs($this->adminUser)
            ->test(ImportExcel::class)
            ->set('type', 'siswa')
            ->set('file', $file)
            ->call('import');

        $test->assertHasNoErrors();
        $this->assertCount(1, $test->get('failures'));
        $test->assertSee('Laporan Kegagalan Impor')
            ->assertSee('Siswa Tanpa NISN');
    }

    public function test_import_excel_component_successful_import()
    {
        $validContent = "nisn,nama,tingkat,nama_kelas\n0088776655,Siswa Livewire Import,X,X-A";
        $file = UploadedFile::fake()->createWithContent('valid_siswa.csv', $validContent);

        $test = Livewire::actingAs($this->adminUser)
            ->test(ImportExcel::class)
            ->set('type', 'siswa')
            ->set('file', $file)
            ->call('import');

        $test->assertHasNoErrors();
        $this->assertCount(0, $test->get('failures'));
        $test->assertDontSee('Laporan Kegagalan Impor');

        $this->assertDatabaseHas('siswa', [
            'nisn' => '0088776655',
            'nama' => 'Siswa Livewire Import',
        ]);
    }
}
