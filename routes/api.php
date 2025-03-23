<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Lomba\LombaAlbumController;
use App\Http\Controllers\Lomba\LombaCategoryController;
use App\Http\Controllers\Lomba\LombaController;
use App\Http\Controllers\Lomba\LombaDetailController;
use App\Http\Controllers\Lomba\LombaHadiahController;
use App\Http\Controllers\Lomba\LombaMemberController;
use App\Http\Controllers\Lomba\LombaTeamController;
use App\Http\Controllers\Lomba\TypeHadiahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Middleware for unauthenticated
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('auth/register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('auth/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

// Middleware for sanctum authenticated route
Route::middleware('auth:sanctum')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // Lomba Route 
    Route::get("lomba", [LombaController::class, 'all'])->name("lomba-get");
    Route::get("lombaCategory/{id_lomba}", [LombaController::class, 'get'])->name("lomba-get");
    Route::post("lomba", [LombaController::class, 'store'])->name("lomba-store");
    Route::put("lomba/{id_lomba}", [LombaController::class, 'update'])->name("lomba-update");
    Route::delete("lomba/{id_lomba}", [LombaController::class, 'destroy'])->name("lomba-delete");

    // Lomba Category Route
    Route::get("lombaCategory", [LombaCategoryController::class, 'all'])->name("lombaCategory-all");
    Route::get("lombaCategory/{id_categoryLomba}", [LombaCategoryController::class, 'get'])->name("lombaCategory-get");
    Route::post("lombaCategory", [LombaCategoryController::class, 'store'])->name("lombaCategory-store");
    Route::put("lombaCategory/{id_categoryLomba}", [LombaCategoryController::class, 'update'])->name("lombaCategory-update");
    Route::delete("lombaCategory/{id_categoryLomba}", [LombaCategoryController::class, 'destroy'])->name("lombaCategory-delete");

    // Lomba Detail Route
    Route::get("lombaDetail", [LombaDetailController::class, 'all'])->name("lombaDetail-all");
    Route::get("lombaDetail/get/{id_lomba}", [LombaDetailController::class, 'get'])->name("lombaDetail-get");

    // Lomba Member Route
    Route::get("lombaMember", [LombaMemberController::class, 'all'])->name("lombaMember-all");
    Route::get("lombaMember/{id_member}", [LombaMemberController::class, 'get'])->name("lombaMember-get");
    Route::post("lombaMember", [LombaMemberController::class, 'store'])->name("lombaMember-store");
    Route::put("lombaMember/{id_member}", [LombaMemberController::class, 'update'])->name("lombaMember-update");
    Route::delete("lombaMember/{id_member}", [LombaMemberController::class, 'destroy'])->name("lombaMember-delete");

    // Lomba Team Route
    Route::get("lombaTeam", [LombaTeamController::class, 'all'])->name("lombaTeam-all");
    Route::get("lombaTeam/{id_team}", [LombaTeamController::class, 'get'])->name("lombaTeam-get");
    Route::post("lombaTeam", [LombaTeamController::class, 'store'])->name("lombaTeam-store");
    Route::put("lombaTeam/{id_team}", [LombaTeamController::class, 'update'])->name("lombaTeam-update");
    Route::delete("lombaTeam/{id_team}", [LombaTeamController::class, 'destroy'])->name("lombaTeam-delete");

    // Type Hadiah Route
    Route::get("typeHadiah", [TypeHadiahController::class, 'all'])->name("typeHadiah-all");
    Route::get("typeHadiah/{id_typeHadiah}", [TypeHadiahController::class, 'get'])->name("typeHadiah-get");
    Route::post("typeHadiah", [TypeHadiahController::class, 'store'])->name("typeHadiah-store");
    Route::put("typeHadiah/{id_typeHadiah}", [TypeHadiahController::class, 'update'])->name("typeHadiah-update");
    Route::delete("typeHadiah/{id_typeHadiah}", [TypeHadiahController::class, 'destroy'])->name("typeHadiah-delete");

    // Lomba Hadiah Route
    Route::get("lombaHadiah", [LombaHadiahController::class, 'all'])->name("lombaHadiah-all");
    Route::get("lombaHadiah/{id_hadiah}", [LombaHadiahController::class, 'get'])->name("lombaHadiah-get");
    Route::post("lombaHadiah", [LombaHadiahController::class, 'store'])->name("lombaHadiah-store");
    Route::put("lombaHadiah/{id_hadiah}", [LombaHadiahController::class, 'update'])->name("lombaHadiah-update");
    Route::delete("lombaHadiah/{id_hadiah}", [LombaHadiahController::class, 'destroy'])->name("lombaHadiah-delete");

    // Lomba Album Route
    Route::get("lombaAlbum", [LombaAlbumController::class, 'all'])->name("lombaAlbum-all");
    Route::get("lombaAlbum/{id_lombaAlbum}", [LombaAlbumController::class, 'get'])->name("lombaAlbum-get");
    Route::post("lombaAlbum", [LombaAlbumController::class, 'store'])->name("lombaAlbum-store");
    Route::put("lombaAlbum/{id_lombaAlbum}", [LombaAlbumController::class, 'update'])->name("lombaAlbum-update");
    Route::delete("lombaAlbum/{id_lombaAlbum}", [LombaAlbumController::class, 'destroy'])->name("lombaAlbum-delete");
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
