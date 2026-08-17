<?php

namespace Tests\Feature;

use App\Imports\GuruImport;
use App\Models\Guru;
use App\Models\User;
use Database\Seeders\RoleAndUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Livewire\Volt\Volt;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class GuruImportTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndUserSeeder::class);
    }

    public function test_guru_import_creates_user_with_nip_as_password_and_must_change_password_flag()
    {
        $nip = '198801012015011005';
        $email = 'gurutest@smartakademik.test';
        $file = UploadedFile::fake()->createWithContent(
            'guru.csv',
            "nip_nuptk,nama,email\n{$nip},Guru Baru,{$email}"
        );

        Excel::import(new GuruImport, $file);

        $this->assertDatabaseHas('guru', [
            'nip_nuptk' => $nip,
            'nama' => 'Guru Baru',
        ]);

        $user = User::where('email', $email)->first();
        $this->assertNotNull($user);
        $this->assertTrue(Hash::check($nip, $user->password));
        $this->assertTrue((bool) $user->must_change_password);
        $this->assertTrue($user->hasRole('guru'));
    }

    public function test_user_with_must_change_password_is_redirected_to_profile_before_accessing_dashboard()
    {
        $nip = '198801012015011005';
        $email = 'gurutest2@smartakademik.test';
        $file = UploadedFile::fake()->createWithContent(
            'guru.csv',
            "nip_nuptk,nama,email\n{$nip},Guru Redirect,{$email}"
        );

        Excel::import(new GuruImport, $file);

        $user = User::where('email', $email)->first();

        // Accessing guru dashboard while must_change_password is true should redirect to profile
        $response = $this->actingAs($user)->get(route('guru.dashboard'));
        $response->assertRedirect(route('profile'));

        // Changing password flips must_change_password to false
        Volt::test('profile.update-password-form')
            ->set('current_password', $nip)
            ->set('password', 'NewSecurePassword123!')
            ->set('password_confirmation', 'NewSecurePassword123!')
            ->call('updatePassword')
            ->assertHasNoErrors();

        $user->refresh();
        $this->assertFalse((bool) $user->must_change_password);
        $this->assertTrue(Hash::check('NewSecurePassword123!', $user->password));

        // Now guru dashboard is accessible
        $responseAfter = $this->actingAs($user)->get(route('guru.dashboard'));
        $responseAfter->assertStatus(200);
    }
}
