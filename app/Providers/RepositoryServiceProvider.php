<?php

namespace App\Providers;

use App\Repositories\Authentication\AuthRepository;
use App\Repositories\Authentication\DefaultAuthRepository;
use App\Repositories\Product\DefaultProductRepository;
use App\Repositories\Product\ProductRepository;
use App\Services\Authentication\AuthService;
use App\Services\Authentication\DefaultAuthService;
use App\Services\Product\DefaultProductService;
use App\Services\Product\ProductService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthService::class, DefaultAuthService::class);
        $this->app->bind(AuthRepository::class, DefaultAuthRepository::class);
        $this->app->bind(ProductService::class, DefaultProductService::class);
        $this->app->bind(ProductRepository::class, DefaultProductRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
