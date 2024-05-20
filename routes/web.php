<?php

use Illuminate\Support\Facades\Route;
use App\Orchid\Screens\ProductEditScreen;
use App\Orchid\Screens\ProductListScreen;
use App\Http\Controllers\ProductController;

Route::middleware(['web', 'platform'])
    ->prefix('admin')
    ->group(function () {
        Route::screen('/products', ProductListScreen::class)->name('platform.product.list');
        Route::screen('/product/{product?}', ProductEditScreen::class)->name('platform.product.edit');
        Route::post('/product/save', [ProductController::class, 'save'])->name('platform.product.save');
    });

Route::get('/', function () {
    return view('welcome');
});