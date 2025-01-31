<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ShopServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutes();
    }

    /**
     * 加載 products.php 路由文件
     */
    protected function loadRoutes(): void
    {
        Route::namespace('App\Http\Controllers\Shop')
            ->prefix('shops')
            ->middleware('web')
            ->group([
                __DIR__ . '/../../routes/shops/products.php',
                __DIR__ . '/../../routes/shops/auth.php',
            ]);
    }
}
