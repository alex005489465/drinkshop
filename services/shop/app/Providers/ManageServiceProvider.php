<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ManageServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot(): void
    {
        $this->loadRoutes();
    }

    /**
     * 加載管理後台相關路由文件
     */
    protected function loadRoutes(): void
    {
        Route::prefix('manages')
            ->middleware('web')
            ->group([
                __DIR__ . '/../../routes/manages/auth.php',
                __DIR__ . '/../../routes/manages/products.php'
            ]);
    }
}
