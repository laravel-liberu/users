<?php

namespace LaravelLiberu\Users;

use Illuminate\Support\ServiceProvider;
use LaravelLiberu\Users\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->load()
            ->publish()
            ->mapMorphs();
    }

    private function load()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        return $this;
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/../database/factories' => database_path('factories'),
        ], ['user-factories', 'liberu-factories']);

        $this->publishes([
            __DIR__.'/../database/seeders' => database_path('seeders'),
        ], ['user-seeders', 'liberu-seeders']);

        return $this;
    }

    private function mapMorphs()
    {
        User::morphMap();

        return $this;
    }

    public function register()
    {
        //
    }
}
