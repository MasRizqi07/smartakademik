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
}
