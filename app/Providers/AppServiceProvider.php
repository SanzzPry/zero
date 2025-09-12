<?php

namespace App\Providers;

use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Services\User\UserServiceImplement;
use App\Services\SuperAdmin\SuperAdminService;
use App\Repositories\User\UserRepositoryImplement;
use App\Repositories\SuperAdmin\SuperAdminRepository;
use App\Services\SuperAdmin\SuperAdminServiceImplement;
use App\Repositories\SuperAdmin\SuperAdminRepositoryImplement;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserService::class, UserServiceImplement::class);
        $this->app->bind(UserRepository::class, UserRepositoryImplement::class);
        $this->app->bind(SuperAdminService::class, SuperAdminServiceImplement::class);
        $this->app->bind(SuperAdminRepository::class, SuperAdminRepositoryImplement::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
