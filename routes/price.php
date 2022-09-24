<?php

use App\Http\Controllers\Product\PriceHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('price-history/{id}', [PriceHistoryController::class, 'getPriceHistoryChart'])
    ->name('history.price');
