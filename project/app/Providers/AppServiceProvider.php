<?php

namespace App\Providers;

use App\Interfaces\Admin\CategoryInterface;
use App\Interfaces\Profile\ProfileInterface;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Profile\ProfileRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryInterface::class,CategoryRepository::class);
        $this->app->bind(ProfileInterface::class,ProfileRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
