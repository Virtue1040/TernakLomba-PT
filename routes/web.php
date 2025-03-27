<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('display.landingPage.index');
})->name('landing');

Route::middleware('auth:sanctum', 'web')->group(function () {
    Route::get('/fill', function() {
        return view('display.registData.index');    
    })->name("fill");
});

Route::middleware('guests', 'web')->group(function () {
    Route::get('/auth/login', [AuthenticatedSessionController::class, 'create'])->name("login");
    Route::get('/auth/register', [RegisteredUserController::class, 'create'])->name("register");
});

Route::get('language/{locale}', function ($locale) {
    if (! in_array($locale, config('app.available_locales'))) {
        abort(400);
    }
 
    App::setLocale($locale);
    return redirect()->back();
});

Route::get('/explore', function () {
    return view('display.exploreLomba.index');
});

Route::get('/detail', function() {
    return view('display.detailLomba.index');
});

Route::get('/searchTeam', function() {
    return view('display.Team.searchTeam');
});

Route::get('/regist/data', function() {
    return view('display.registData.index');
});