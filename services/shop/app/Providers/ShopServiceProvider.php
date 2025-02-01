<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Events\Auth\RegisteredUser;
use App\Listeners\Shop\CreateUserDetailsAfterRegistration;

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
     * 加載商店相關路由文件
     * 包含商品、認證等功能路由
     */
    protected function loadRoutes(): void
    {
        Route::namespace('App\Http\Controllers\Shop')
            ->prefix('shops')
            ->middleware('web')
            ->group([
                __DIR__ . '/../../routes/shops/products.php',
                __DIR__ . '/../../routes/shops/auth.php',
                __DIR__ . '/../../routes/shops/user.php'
            ]);
    }
}
