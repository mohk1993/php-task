<?php

use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('product')->group(function () {
    Route::get('view', [ProductController::class, 'viewProducts'])
                ->name('products.view');

    Route::get('view-add', [ProductController::class, 'viewAddProduct'])
                ->name('product.add.view');

    Route::get('view-update/{id}', [ProductController::class, 'viewUpdateProduct'])
                ->name('product.update.view');
    
    Route::post('add', [ProductController::class, 'addProduct'])
                ->name('product.add');

    Route::post('update/{id}', [ProductController::class, 'update'])
                ->name('product.update');

    Route::get('delete/{id}', [ProductController::class, 'delete'])
                ->name('product.delete');
});