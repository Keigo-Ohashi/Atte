<?php

namespace App\Providers;

use App\Services\Attendance\AttendanceService;
use App\Services\Attendance\AttendanceServiceImpl;
use App\Services\User\UserService;
use App\Services\User\UserServiceImpl;
use App\Repositories\Attendance\AttendanceRepository;
use App\Repositories\Attendance\AttendanceRepositoryImpl;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryImpl;


use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // wired(AttendanceService)
        $this->app->singleton(AttendanceService::class, AttendanceServiceImpl::class);

        // wired(UserService)
        $this->app->singleton(UserService::class, UserServiceImpl::class);

        // wired(AttendanceRepository)
        $this->app->singleton(AttendanceRepository::class, AttendanceRepositoryImpl::class);

        // wired(UserRepository)
        $this->app->singleton(UserRepository::class, UserRepositoryImpl::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
