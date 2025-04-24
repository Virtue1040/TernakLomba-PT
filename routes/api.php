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
use App\Http\Controllers\UsersDetailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Middleware for unauthenticated
Route::middleware('guests', 'web')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('auth/register', [RegisteredUserController::class, 'store'])->name('auth-register');

    Route::get('login', [AuthenticatedSessionController::class, 'create']);

    Route::post('auth/login', [AuthenticatedSessionController::class, 'store'])->name('auth-login');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

        Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
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

    // Lomba Route 
    Route::get("v1/lomba", [LombaController::class, 'all'])->name("lomba-get");
    Route::get("v1/lombaCategory/{id_lomba}", [LombaController::class, 'get'])->name("lomba-get");
    Route::post("v1/lomba", [LombaController::class, 'store'])->name("lomba-store");
    Route::put("v1/lomba/{id_lomba}", [LombaController::class, 'update'])->name("lomba-update");
    Route::delete("v1/lomba/{id_lomba}", [LombaController::class, 'destroy'])->name("lomba-delete");

    // Lomba Category Route
    Route::get("v1/lombaCategory", [LombaCategoryController::class, 'all'])->name("lombaCategory-all");
    Route::get("v1/lombaCategory/{id_categoryLomba}", [LombaCategoryController::class, 'get'])->name("lombaCategory-get");
    Route::post("v1/lombaCategory", [LombaCategoryController::class, 'store'])->name("lombaCategory-store");
    Route::put("v1/lombaCategory/{id_categoryLomba}", [LombaCategoryController::class, 'update'])->name("lombaCategory-update");
    Route::delete("v1/lombaCategory/{id_categoryLomba}", [LombaCategoryController::class, 'destroy'])->name("lombaCategory-delete");

    // Profiling Route
    Route::post("v1/profiling", [UsersDetailController::class, 'profiling'])->name("usersDetail-store");

    // Lomba Detail Route
    Route::get("v1/lombaDetail", [LombaDetailController::class, 'all'])->name("lombaDetail-all");
    Route::get("v1/lombaDetail/get/{id_lomba}", [LombaDetailController::class, 'get'])->name("lombaDetail-get");

    // Lomba Member Route
    Route::get("v1/lombaMember", [LombaMemberController::class, 'all'])->name("lombaMember-all");
    Route::get("v1/lombaMember/{id_member}", [LombaMemberController::class, 'get'])->name("lombaMember-get");
    Route::post("v1/lombaMember", [LombaMemberController::class, 'store'])->name("lombaMember-store");
    Route::put("v1/lombaMember/{id_member}", [LombaMemberController::class, 'update'])->name("lombaMember-update");
    Route::delete("v1/lombaMember/{id_member}", [LombaMemberController::class, 'destroy'])->name("lombaMember-delete");

    // Lomba Team Route
    Route::get("v1/lombaTeam", [LombaTeamController::class, 'all'])->name("lombaTeam-all");
    Route::get("v1/lombaTeam/{id_team}", [LombaTeamController::class, 'get'])->name("lombaTeam-get");
    Route::post("v1/lombaTeam", [LombaTeamController::class, 'store'])->name("lombaTeam-store");
    Route::put("v1/lombaTeam/{id_team}", [LombaTeamController::class, 'update'])->name("lombaTeam-update");
    Route::delete("v1/lombaTeam/{id_team}", [LombaTeamController::class, 'destroy'])->name("lombaTeam-delete");

    // Type Hadiah Route
    Route::get("v1/typeHadiah", [TypeHadiahController::class, 'all'])->name("typeHadiah-all");
    Route::get("v1/typeHadiah/{id_typeHadiah}", [TypeHadiahController::class, 'get'])->name("typeHadiah-get");
    Route::post("v1/typeHadiah", [TypeHadiahController::class, 'store'])->name("typeHadiah-store");
    Route::put("v1/typeHadiah/{id_typeHadiah}", [TypeHadiahController::class, 'update'])->name("typeHadiah-update");
    Route::delete("v1/typeHadiah/{id_typeHadiah}", [TypeHadiahController::class, 'destroy'])->name("typeHadiah-delete");

    // Lomba Hadiah Route
    Route::get("v1/lombaHadiah", [LombaHadiahController::class, 'all'])->name("lombaHadiah-all");
    Route::get("v1/lombaHadiah/{id_hadiah}", [LombaHadiahController::class, 'get'])->name("lombaHadiah-get");
    Route::post("v1/lombaHadiah", [LombaHadiahController::class, 'store'])->name("lombaHadiah-store");
    Route::put("v1/lombaHadiah/{id_hadiah}", [LombaHadiahController::class, 'update'])->name("lombaHadiah-update");
    Route::delete("v1/lombaHadiah/{id_hadiah}", [LombaHadiahController::class, 'destroy'])->name("lombaHadiah-delete");

    // Lomba Album Route
    Route::get("v1/lombaAlbum", [LombaAlbumController::class, 'all'])->name("lombaAlbum-all");
    Route::get("v1/lombaAlbum/{id_lombaAlbum}", [LombaAlbumController::class, 'get'])->name("lombaAlbum-get");
    Route::post("v1/lombaAlbum", [LombaAlbumController::class, 'store'])->name("lombaAlbum-store");
    Route::put("v1/lombaAlbum/{id_lombaAlbum}", [LombaAlbumController::class, 'update'])->name("lombaAlbum-update");
    Route::delete("v1/lombaAlbum/{id_lombaAlbum}", [LombaAlbumController::class, 'destroy'])->name("lombaAlbum-delete");
})->middleware("web");

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('web', 'auth:sanctum');
