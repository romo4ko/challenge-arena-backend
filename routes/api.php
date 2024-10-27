<?php

declare(strict_types=1);

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\TelegramController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register'])->name('auth.register');
Route::post('auth', [AuthController::class, 'auth'])->name('auth.auth');

Route::group(['middleware' => ['auth:sanctum']], static function () {
    Route::group(['prefix' => 'users'], static function () {
        Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
        Route::post('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('/{id}/teams', [UserController::class, 'team'])->name('users.team');
        Route::get('/{id}/challenges', [UserController::class, 'challenge'])->name('users.challenge');
        Route::get('/{id}/achievements', [UserController::class, 'achievement'])->name('users.achievement');
    });

    Route::group(['prefix' => 'teams'], static function () {
        Route::get('/{id}', [TeamController::class, 'show'])->name('teams.show');
        Route::post('/{id}', [TeamController::class, 'update'])->name('teams.update');
        Route::get('/{id}/members', [TeamController::class, 'members'])->name('teams.members');
    });
});

Route::post('sync-telegram', [TelegramController::class, 'syncTelegram'])->name('auth.syncTelegram');
