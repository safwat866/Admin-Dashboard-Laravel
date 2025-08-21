<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShowUser;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShowUser::class, "show"])->name('/')->middleware('checkUser');

Route::get('/login', function() {
    return view('login');
})->name('login');

Route::post("/login/handle", [LoginController::class, 'checkUser'])->name('login.handle');

Route::get("/register", function () {
    return view('register');
})->name('register');

Route::post('register/handle', [RegisterController::class, 'createUser'])->name('register.handle');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');