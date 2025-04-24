<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UsersDetailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('display.landingPage.index');
})->name('landing');

Route::middleware('auth:sanctum', 'profilled', 'web')->group(function () {
    Route::get('/profiling', [UsersDetailController::class, "index"])->name("profiling")->withoutMiddleware('profilled')->middleware("unprofilled");
    Route::get('/dashboard', function() {
        return view('display.dashboard.index.index');
    })->name("dashboard-index");
    
    Route::get('/dashboard/explore', function() {
        return view('display.dashboard.explore.index');
    })->name("dashboard-explore");
    
    Route::get('/dashboard/chat', function() {
        return view('display.dashboard.chat.index');
    })->name("dashboard-chat");
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

Route::get('/detail', function() {
    return view('display.detailLomba.index');
});

Route::get('/searchTeam', function() {
    return view('display.Team.searchTeam');
});

Route::get('/profile', function() {
    return view('display.profile.index');
});