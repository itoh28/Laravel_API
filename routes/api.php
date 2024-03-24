<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TagController;

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

Route::post('/users', [RegisterController::class, 'register']);

Route::post('/users/login', [LoginController::class, 'login']);

Route::get('/articles', [ArticleController::class, 'index']);

Route::post('/articles', [ArticleController::class, 'create']);

Route::get('/articles/{slug}', [ArticleController::class, 'show']);

Route::put('/articles/{slug}', [ArticleController::class, 'update']);

Route::delete('/articles/{slug}', [ArticleController::class, 'delete']);

Route::get('/tags', [TagController::class, 'tags']);
