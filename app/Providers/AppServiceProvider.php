<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\ProductService;
use App\Services\ProductServiceImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
          $this->app->bind(ProductService::class, ProductServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
