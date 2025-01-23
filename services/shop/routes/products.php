<?php

use App\Http\Controllers\Product\SheetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\PriceController;
use App\Http\Controllers\Product\IngredientController;

Route::get('/sheets', [SheetController::class, 'index'])
    ->name('sheets.list');
Route::post('/sheets', [SheetController::class, 'store'])
    ->name('sheets.saved');

Route::get('/prices', [PriceController::class, 'index'])
    ->name('prices.index');
Route::post('/prices/update', [PriceController::class, 'update'])
    ->name('prices.update');

Route::get('/ingredients', [IngredientController::class, 'index'])
    ->name('ingredients.index');
Route::post('/ingredients/update', [IngredientController::class, 'update'])
    ->name('ingredients.update');
Route::post('/ingredients/store', [IngredientController::class, 'store'])
    ->name('ingredients.create');