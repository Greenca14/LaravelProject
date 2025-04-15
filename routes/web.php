<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PublicationController;

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