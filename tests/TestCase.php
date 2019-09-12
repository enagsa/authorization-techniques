<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use App\Models\User;
use App\Models\Users\Admin;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function createAdmin(array $attributes = []){
        return factory(Admin::class)->create($attributes);
    }

    protected function createUser(array $attributes = []){
    	return factory(User::class)->create($attributes);;
    }

    protected function actingAsAdmin($admin = null){
        if($admin == null)
            $admin = $this->createAdmin();

        return $this->actingAs($admin, 'admin');
    }

    protected function actingAsUser($user = null){
        if($user == null)
            $user = $this->createUser();
        
        return $this->actingAs($user);
    }

    /**
     * Set the currently logged in user for the application.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string|null  $driver
     * @return $this
     */
    public function be(UserContract $user, $driver = null)
    {
        if (isset($user->wasRecentlyCreated) && $user->wasRecentlyCreated) {
            $user->wasRecentlyCreated = false;
        }

        $this->app['auth']->guard($driver)->setUser($user);

        return $this;
    }
}
