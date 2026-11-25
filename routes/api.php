<?php

use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// CRUD standar entitas Media (index, show, store, update, destroy)
Route::apiResource('media', MediaController::class);

// Menampilkan profil pengguna beserta koleksi media miliknya
Route::get('/users/{user}', [UserController::class, 'show']);

// Custom action: menambah dan menghapus media dari koleksi pengguna
Route::post('/users/{user}/collection', [UserController::class, 'addToCollection']);
Route::delete('/users/{user}/collection/{media}', [UserController::class, 'removeFromCollection']);
