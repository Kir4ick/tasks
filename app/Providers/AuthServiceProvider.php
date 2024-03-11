<?php

namespace App\Providers;

use App\Http\Guards\JWTGuard;
use App\Http\Policies\TaskPolicy;
use App\Models\Task;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Tymon\JWTAuth\JWT;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Task::class => TaskPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::extend('jwt-auth', function (Application $app, $name, array $config) {
            return new JWTGuard($app->get(JWT::class), $app->get(Request::class));
        });
    }
}
