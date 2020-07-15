<?php

namespace App\Providers;

use App\Guards\FromApiGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('from_api', function ($app, array $config) {
            return new FromApiUserProvider();
        });

        Auth::extend('from_api', function ($app, $name, array $config) {
            return new FromApiGuard(Auth::createUserProvider($config['provider']));
        });

    }
}
