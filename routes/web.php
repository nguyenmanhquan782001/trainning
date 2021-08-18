<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Admin\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::prefix("user")->group(function () {
    Route::get("/register", [LoginController::class, 'register'])->name("register.view");
    Route::post("/register/post" , [LoginController::class , 'postRegister'])->name("register.post");
    Route::get("/login", [LoginController::class, 'login'])->name("login.view");
    Route::post("/post/login", [LoginController::class, 'postLogin'])->name("login.post");
    Route::get("/logout",[LoginController::class ,'logout'])->name("logout");
});
Route::prefix("admin")->middleware('check_login')->group(function (){
    Route::get("/dashboard" , [DashboardController::class , 'index'])->name("dashboard.index");
});


