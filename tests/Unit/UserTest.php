<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class UserTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    function a_user_can_be_an_admin(){
    	$user = factory(User::class)->create([
    		'admin' => false
    	]);

    	$this->assertFalse($user->isAdmin());

    	$user->admin = true;
    	$user->save();

    	$this->assertTrue($user->isAdmin());
    }
}
