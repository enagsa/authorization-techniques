<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admin_can_visit_the_admin_dashboard(){
        $this->actingAsAdmin()
            ->get(route('admin_dashboard'))
            ->assertStatus(200)
            ->assertSee('Admin Panel');
    }

    /** @test */
    function non_admin_users_cannot_visit_the_admin_dashboard(){
        $this->actingAsUser()
            ->get(route('admin_dashboard'))
            ->assertStatus(302)
            ->assertRedirect(route('admin.login'));
    }

    /** @test */
    function guests_cannot_visit_the_admin_dashboard(){
        $this->get(route('admin_dashboard'))
            ->assertStatus(302)
            ->assertRedirect(route('admin.login'));
    }
}
