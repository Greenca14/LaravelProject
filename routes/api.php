<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JournalController;
use App\Http\Controllers\Api\PersonController;
use App\Http\Controllers\Api\PublicationController;

Route::post('/login', [AuthController::class, 'login']);

// Защищенные маршруты
Route::middleware('auth:sanctum')->group(function () {
    // Пользователь
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/logout', [AuthController::class, 'logout']);
    
    // API ресурсы
    Route::get('/journals', [JournalController::class, 'index']);
    Route::get('/journals/{id}', [JournalController::class, 'show']);
    Route::get('/persons', [PersonController::class, 'index']);
    Route::get('/persons/{id}', [PersonController::class, 'show']);
    Route::get('/publications', [PublicationController::class, 'index']);
    Route::get('/publications/{id}', [PublicationController::class, 'show']);
});