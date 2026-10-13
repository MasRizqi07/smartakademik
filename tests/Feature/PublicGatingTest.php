<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RoleAndUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicGatingTest extends TestCase
{
    use RefreshDatabase;

    public function test_deferred_public_pages_return_404_when_marketing_feature_disabled(): void
    {
        $deferredUrls = [
            '/tentang',
            '/fitur',
            '/prestasi',
            '/kalender',
            '/bantuan',
            '/kontak',
        ];

        foreach ($deferredUrls as $url) {
            $response = $this->get($url);
            $response->assertNotFound();
        }
    }

    public function test_home_redirects_to_portal_and_core_entrypoints_return_200(): void
    {
        $this->get('/')
            ->assertRedirect('/portal');

        $this->get('/portal')
            ->assertOk();

        $this->get('/login')
            ->assertOk();
    }

    public function test_four_role_dashboards_render_successfully_without_route_exceptions(): void
    {
        $this->seed(RoleAndUserSeeder::class);

        $admin = User::where('email', 'admin@smartakademik.test')->first();
        $waka = User::where('email', 'waka@smartakademik.test')->first();
        $guru = User::where('email', 'guru@smartakademik.test')->first();
        $siswa = User::where('email', 'siswa@smartakademik.test')->first();

        $this->actingAs($admin)
            ->get('/admin/dashboard')
            ->assertOk();

        $this->actingAs($waka)
            ->get('/waka/dashboard')
            ->assertOk();

        $this->actingAs($guru)
            ->get('/guru/dashboard')
            ->assertOk();

        $this->actingAs($siswa)
            ->get('/siswa/dashboard')
            ->assertOk();
    }
}
