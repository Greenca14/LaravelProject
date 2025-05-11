<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello', [ 'title' => 'Hello world!']);
});
 
Route::get('/persons/{id}', [PersonController::class, 'show'])->name('persons.show');

Route::resource('journals', JournalController::class);
Route::resource('publications', PublicationController::class);
Route::resource('persons', PersonController::class)->only(['show']);

// Аутентификация
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Защищенные маршруты
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware(['auth', 'admin']);

    // Публичные маршруты (доступны всем)
Route::get('/publications', [PublicationController::class, 'index'])->name('publications.index');
Route::get('/publications/{publication}', [PublicationController::class, 'show'])->name('publications.show');

// Защищенные маршруты (только для админа)
Route::middleware(['can:admin'])->group(function () {
    Route::get('/publications/create', [PublicationController::class, 'create'])->name('publications.create');
    Route::post('/publications', [PublicationController::class, 'store'])->name('publications.store');
    Route::get('/publications/{publication}/edit', [PublicationController::class, 'edit'])->name('publications.edit');
    Route::put('/publications/{publication}', [PublicationController::class, 'update'])->name('publications.update');
    Route::delete('/publications/{publication}', [PublicationController::class, 'destroy'])->name('publications.destroy');
});