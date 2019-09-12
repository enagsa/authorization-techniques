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
    function a_user_cannot_be_an_admin(){
    	$user = $this->createUser();

    	$this->assertFalse($user->isAdmin());
    }
}
