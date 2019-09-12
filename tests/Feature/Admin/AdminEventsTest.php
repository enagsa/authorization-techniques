<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class AdminEventsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admin_can_visit_the_admin_events_page(){
        $this->actingAsAdmin()
            ->get(route('admin_events'))
            ->assertStatus(200)
            ->assertSee('Admin Events');
    }

    /** @test */
    function non_admin_users_cannot_visit_the_admin_events_page(){
        $this->actingAsUser()
            ->get(route('admin_events'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /** @test */
    function guests_cannot_visit_the_admin_events_page(){
        $this->get(route('admin_events'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }
}
