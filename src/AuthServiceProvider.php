<?php

namespace LaravelLiberu\Users;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use LaravelLiberu\Users\Models\User;
use LaravelLiberu\Users\Policies\User as Policy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => Policy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
