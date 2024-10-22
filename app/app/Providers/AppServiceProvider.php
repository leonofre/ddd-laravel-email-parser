<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domains\User\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistence\Repositories\EloquentUserRepository;
use App\Domains\SuccessfulEmail\Repositories\SuccessfulEmailRepositoryInterface;
use App\Infrastructure\Persistence\Repositories\EloquentSuccessfulEmailRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(SuccessfulEmailRepositoryInterface::class, EloquentSuccessfulEmailRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
