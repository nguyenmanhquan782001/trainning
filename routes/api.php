<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("/posts", [PostController::class, 'index']);
Route::post("/posts/store", [PostController::class, 'store']);
Route::get("/posts/show/{id}", [PostController::class, 'show']);
Route::post("/posts/update/{id}", [PostController::class, 'update']);

Route::get("/comments", [CommentController::class , 'index']);

