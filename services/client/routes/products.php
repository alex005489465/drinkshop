<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\Show;

Route::get('/', [Show::class, 'index'])->name('list');
Route::get('/{id}', [Show::class, 'show'])->name('show');