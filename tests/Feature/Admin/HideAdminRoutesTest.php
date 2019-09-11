<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class HideAdminRoutesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_does_not_allow_guests_to_discover_admin_urls(){
        $this->get('/admin/invalid-url')
            ->assertStatus(302)
            ->assertRedirect('login');
    }

    /** @test */
    function it_does_not_allow_guests_to_discover_admin_urls_using_post(){
        $this->post('/admin/invalid-url')
            ->assertStatus(302)
            ->assertRedirect('login');
    }

    /** @test */
    function it_displays_404s_when_admins_visit_invalid_urls(){
        $admin = factory(User::class)->create([
            'admin' => true
        ]);

        $this->actingAs($admin)
            ->get('/admin/invalid-url')
            ->assertStatus(404);
    }
}
