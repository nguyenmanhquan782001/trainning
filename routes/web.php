<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Register\RegisterController;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;


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
    Route::get("/register", [RegisterController::class, 'register'])->name("register.view");
    Route::post("/register/post", [RegisterController::class, 'store'])->name("register.post");

    Route::get('/redirect', [LoginController::class , 'redirect'])->name("login.redirect");
    Route::get('/callback', [LoginController::class , 'callback'])->name("login.callback");

    Route::get("/login", [LoginController::class, 'login'])->name("login.view");
    Route::post("/post/login", [LoginController::class, 'store'])->name("login.post");

    Route::get("/logout", [LoginController::class, 'logout'])->name("logout");

});

Route::prefix("admin")->middleware(['checkLogin'])->group(function () {

    Route::get("/dashboard", [DashboardController::class, 'index'])->name("dashboard.index");

});


