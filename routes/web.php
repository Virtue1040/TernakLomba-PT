<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\Lomba\LombaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersDetailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('display.landingPage.index');
})->name('landing');

Route::middleware('auth:sanctum', 'profilled', 'web')->group(function () {
    Route::get('/profiling', [UsersDetailController::class, "index"])->name("profiling")->withoutMiddleware('profilled')->middleware("unprofilled");
    Route::get('/profile/{id_user?}',[ProfileController::class, "index"])->name("profile");

    // Dashboard Route
    Route::get('/dashboard', function() {
        return view('display.dashboard.index.index');
    })->name("dashboard-index");

    Route::get('/dashboard/explore', [LombaController::class, "index"])->name("dashboard-explore");
    Route::get('/dashboard/chat', [CommunicationController::class,"index"])->name("dashboard-chat");
    Route::get('dashboard/admin', [LombaController::class, "admin"])->name("dashboard-admin")->middleware('admin');

    Route::get('detail/{id_lomba}/compspace', [LombaController::class,"compspace"])->name("lomba-compspace");

    // Test Route
    Route::get('/profiling-test', [UsersDetailController::class, "index"])->name("profiling-test")->withoutMiddleware('profilled');
});

Route::get("/requestKompetisi", [LombaController::class, "create"])->name("request-kompetisi");

Route::middleware('guests', 'web')->group(function () {
    Route::get('/auth/login', [AuthenticatedSessionController::class, 'create'])->name("login");
    Route::get('/auth/register', [RegisteredUserController::class, 'create'])->name("register");
    Route::get('/auth/forgot', [PasswordResetLinkController::class, 'create'])->name("forgot-password");
});

Route::get('/detail/{id_lomba}', [LombaController::class, "show"])->name("lomba-detail");