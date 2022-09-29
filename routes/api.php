<?php

use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\Product\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('guest')->group(function () {
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::prefix('v1/product')->middleware('auth:sanctum')->namespace('App\Http\Controllers\Api\Product')->name('api.v1.product.')->group(
    function () {
        Route::get('status', function () {
            return response()->json(['status' => 'Ok']);
        })->name('status');

        Route::get('list', [ProductController::class, 'getProductList']);

    });
