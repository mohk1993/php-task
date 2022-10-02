<?php

use App\Http\Controllers\Product\QuantityHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('products/{product}/quantity', [QuantityHistoryController::class, 'show'])
    ->name('quantity.show');
