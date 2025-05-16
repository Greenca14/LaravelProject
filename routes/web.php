<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

// Главная страница
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Аутентификация
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// Выход
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Защищенные маршруты
Route::middleware('auth')->group(function () {
    Route::resource('publications', PublicationController::class);
    Route::resource('journals', JournalController::class);
    Route::resource('persons', PersonController::class);
});