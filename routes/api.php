<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthControllerApi;
use App\Http\Controllers\Api\JournalControllerApi;
use App\Http\Controllers\Api\PersonControllerApi;
use App\Http\Controllers\Api\PublicationControllerApi;

// Публичные маршруты
Route::post('/persons', [PersonControllerApi::class, 'store']);
Route::post('/login', [AuthControllerApi::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/journals', [JournalControllerApi::class, 'index']);
    Route::get('/journals_total', [JournalControllerApi::class, 'total']);
    Route::get('/journals/{id}', [JournalControllerApi::class, 'show']);

    Route::get('/persons', [PersonControllerApi::class, 'index']);
    Route::get('/persons_total', [PersonControllerApi::class, 'total']);
    Route::get('/persons/{id}', [PersonControllerApi::class, 'show']);

    Route::get('/publications', [PublicationControllerApi::class, 'index']);
    Route::get('/publications_total', [PublicationControllerApi::class, 'total']);
    Route::get('/publications/{id}', [PublicationControllerApi::class, 'show']);

    // Пользовательские маршруты
    Route::get('/user', [AuthControllerApi::class, 'user']);
    Route::get('/logout', [AuthControllerApi::class, 'logout']);
});
