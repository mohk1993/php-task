<?php

namespace App\Http\Controllers\Language;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function toEn($locale)
    {
        Session::put('locale', $locale);

        return redirect()->back();
    }

    public function toLt($locale)
    {
        Session::put('locale', $locale);

        return redirect()->back();
    }
}
