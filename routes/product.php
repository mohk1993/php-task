<?php

use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('product')->group(function () {
    Route::get('view', [ProductController::class, 'viewProducts'])
                ->name('products.view');

    
});