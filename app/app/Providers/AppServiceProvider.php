<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domains\User\Repositories\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
