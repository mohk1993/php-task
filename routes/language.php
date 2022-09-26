<?php

use App\Http\Controllers\Language\LanguageController;
use Illuminate\Support\Facades\Route;

Route::get('en/{locale}', [LanguageController::class, 'toEn'])->name('en');

Route::get('lt/{locale}', [LanguageController::class, 'toLt'])->name('lt');
