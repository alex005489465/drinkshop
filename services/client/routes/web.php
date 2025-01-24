<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

require __DIR__.'/auth.php';

Route::prefix('products')
    ->name('products.')
    ->group(base_path('routes/products.php'));

