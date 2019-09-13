<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_shows_the_dashboard_page_to_authenticated_users(){
        $this->actingAsUser()
            ->get(route('home'))
            ->assertStatus(200)
            ->assertSee('Dashboard');
    }

    /** @test */
    function it_shows_the_dashboard_page_to_authenticated_admins(){
        $this->actingAsAdmin()
            ->get(route('home'))
            ->assertStatus(200)
            ->assertSee('Dashboard');
    }

    /** @test */
    function it_redirects_guest_users_to_login_page(){
        $this->get(route('home'))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
    }
}
