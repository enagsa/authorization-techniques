<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Blade;
use App\Models\User;

class CustomDirectivesTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    function admin_directive_is_false_for_guests(){
    	$this->assertFalse(Blade::check('admin'));
    }

    /** @test */
    function admin_directive_is_false_for_non_admins(){
    	$user = factory(User::class)->create([
    		'admin' => false
    	]);

    	$this->actingAs($user)
    		->assertFalse(Blade::check('admin'));
    }

    /** @test */
    function admin_directive_is_true_for_admins(){
    	$user = factory(User::class)->create([
    		'admin' => true
    	]);

    	$this->actingAs($user)
    		->assertTrue(Blade::check('admin'));
    }
}
