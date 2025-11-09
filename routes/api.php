<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JournalController;
use App\Http\Controllers\Api\PersonController;
use App\Http\Controllers\Api\PublicationController;

// Journal API routes
Route::get('/journals', [JournalController::class, 'index']);
Route::get('/journals/{id}', [JournalController::class, 'show']);

// Person API routes  
Route::get('/persons', [PersonController::class, 'index']);
Route::get('/persons/{id}', [PersonController::class, 'show']);

// Publication API routes
Route::get('/publications', [PublicationController::class, 'index']);
Route::get('/publications/{id}', [PublicationController::class, 'show']); 