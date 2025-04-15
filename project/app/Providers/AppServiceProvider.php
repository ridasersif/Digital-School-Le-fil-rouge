<?php

namespace App\Providers;

use App\Interfaces\Admin\CategoryInterface;
use App\Interfaces\Profile\ProfileInterface;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Profile\ProfileRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\CoursInterface;
use App\Repositories\CoursRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryInterface::class,CategoryRepository::class);
        $this->app->bind(ProfileInterface::class,ProfileRepository::class);
        $this->app->bind(CoursInterface::class, CoursRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
