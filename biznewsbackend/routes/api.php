<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/all', [NewsController::class, 'all']);
Route::get('/news/{id}', [NewsController::class, 'show']);
Route::post('/news', [NewsController::class, 'store']);
Route::post('/news/{id}', [NewsController::class, 'update']);
Route::delete('/news/{id}', [NewsController::class, 'destroy']);
Route::post('/news/{id}/heart', [NewsController::class, 'addHeart']);
Route::put('/news/{id}/publish', [NewsController::class, 'publish']);
Route::get('/news-by-category', [NewsController::class, 'newsByCategory']);


Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/admin/logout', [AdminAuthController::class, 'logout']);


Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/tags', [TagController::class, 'index']);
Route::get('/authors', [AuthorController::class, 'index']);
Route::post('/authors', [AuthorController::class, 'store']);


Route::get('/videos', [VideoController::class, 'index']);
Route::post('/videos/upload', [VideoController::class, 'upload']);
