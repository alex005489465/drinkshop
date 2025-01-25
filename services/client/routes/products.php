<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\Show;

Route::prefix('products')->name('products.')
    ->group(function () {
        Route::get('/', [Show::class, 'index'])->name('list');
        Route::get('/{id}', [Show::class, 'show'])->name('show');
        Route::get('/select', [Show::class, 'select'])->name('select');
        Route::get('/yy', [Show::class, 'yy'])->name('vue');
    });
    /*
Route::get('/', [Show::class, 'index'])->name('list');
Route::get('/{id}', [Show::class, 'show'])->name('show');
Route::get('/select', [Show::class, 'select'])->name('select');
*/