<?php

use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('product')->group(function () {
    Route::get('view', [ProductController::class, 'view'])
        ->name('products.view');

    Route::get('view-add', [ProductController::class, 'viewAdd'])
        ->name('product.add.view');

    Route::get('view-update/{id}', [ProductController::class, 'viewUpdate'])
        ->name('product.update.view');

    Route::post('add', [ProductController::class, 'add'])
        ->name('product.add');

    Route::post('update/{id}', [ProductController::class, 'update'])
        ->name('product.update');

    Route::get('delete/{id}', [ProductController::class, 'delete'])
        ->name('product.delete');

    Route::get('info/{id}', [ProductController::class, 'viewInfo'])->name('info.product');
});

require __DIR__ . '/price.php';
require __DIR__ . '/quantity.php';
