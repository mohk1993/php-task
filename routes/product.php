<?php

use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('product')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('product.create');

    Route::post('/products', [ProductController::class, 'store'])
        ->name('product.store');

    Route::get('/products/{product}', [ProductController::class, 'show'])
        ->name('product.show');

    Route::get('products/{product}/edit', [ProductController::class, 'edit'])
        ->name('product.edit');

    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->name('product.update');

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->name('product.destroy');

});

require __DIR__ . '/price.php';
require __DIR__ . '/quantity.php';
