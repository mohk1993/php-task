<?php

use App\Http\Controllers\Product\QuantityHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('quantity-history/{id}', [QuantityHistoryController::class, 'getQuantityHistoryChart'])
    ->name('history.quantity');
