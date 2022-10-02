<?php

use App\Http\Controllers\Product\PriceHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('products/{product}/price', [PriceHistoryController::class, 'show'])
    ->name('price.show');
