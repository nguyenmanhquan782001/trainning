<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Register\RegisterController;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Mail\TestMail;


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
    return view('login.login');
});

Route::prefix("user")->group(function () {

    Route::get("/register", [RegisterController::class, 'register'])->name("register.view");
    Route::post("/register/post", [RegisterController::class, 'store'])->name("register.post");
    Route::get("/verification", [RegisterController::class, 'verification'])->name("verification");

    Route::get('/redirect', [LoginController::class, 'redirect'])->name("login.redirect");
    Route::get('/callback', [LoginController::class, 'callback'])->name("login.callback");
    Route::get("/forgot", [LoginController::class, 'forgot'])->name("forgot");
    Route::post("/refresh", [LoginController::class, 'changePassword'])->name("change");
    Route::get("/login", [LoginController::class, 'login'])->name("login.view");
    Route::post("/post/login", [LoginController::class, 'store'])->name("login.post");
    Route::get("/logout", [LoginController::class, 'logout'])->name("logout");

});

Route::prefix("admin")->middleware(['checkLogin'])->group(function () {
    Route::get("/dashboard", [DashboardController::class, 'index'])->name("dashboard.index");
});
Route::get("send-mail", [TestMail::class, 'sendEmail']);
Route::get("/forgot-pass", [LoginController::class, 'forgotPassword'])->name("forgot.pass");
Route::post("/forgot_pass", [LoginController::class, 'postForgot'])->name("forgot.post");
Route::get("/form_forgot_pass", [LoginController::class, 'getEmail'])->name("email.get");
Route::post("/post_pass", [LoginController::class, 'postPass'])->name("post.pass");


