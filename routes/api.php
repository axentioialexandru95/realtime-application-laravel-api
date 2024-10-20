<?php

use App\Http\Controllers\GamesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('games', [GamesController::class, 'index']);
    Route::post('games/{game}/join', [GamesController::class, 'join']);
    Route::post('games/{game}/leave', [GamesController::class, 'leave']);
});
