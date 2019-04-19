<?php

namespace App\Providers;

use App\Observers\UserObserver;
use App\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Map to slug instead of class
        Relation::morphMap([
            'team' => 'App\Team',
            'group' => 'App\Group'
        ]);

        // is an admin
        Blade::if('admin', function(){
            return Auth::user()->isAdmin;
        });

        // User model events
        User::observe(UserObserver::class);
    }
}
