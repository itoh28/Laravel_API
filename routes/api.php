<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArticleCreateController;
use App\Http\Controllers\ArticleGetController;
use App\Http\Controllers\ArticleUpdateController;
use App\Http\Controllers\ArticleDeleteController;

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

Route::post('/articles', [ArticleCreateController::class, 'create']);

Route::get('/articles/{slug}', [ArticleGetController::class, 'get']);

Route::put('/articles/{slug}', [ArticleUpdateController::class, 'update']);

Route::delete('/articles/{slug}', [ArticleDeleteController::class, 'delete']);
