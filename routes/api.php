<?php

use App\Http\Controllers\User\BooksController;
use App\Http\Controllers\User\PeminjamanApiController;
use App\Http\Controllers\User\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Authentication Routes (Public)
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

// Books API Routes (Public)
Route::get('/books', [BooksController::class, 'index']);
Route::get('/books/search', [BooksController::class, 'search']);
Route::get('/books/{id}', [BooksController::class, 'show']);

// Peminjaman Routes
Route::get('/peminjaman', [PeminjamanApiController::class, 'index']);
Route::post('/peminjaman', [PeminjamanApiController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {

});
