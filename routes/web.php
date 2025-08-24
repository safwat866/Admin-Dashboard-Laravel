<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShowUser;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Main Routes
Route::get("/", [IndexController::class, "showProducts"])->name("/")->middleware('checkUser');

Route::get('/dashboard', [AdminController::class, "index"])->middleware('checkUser')->middleware("isAdmin")->name('dashboard');

Route::resource("/dashboard/products", ProductsController::class);

Route::get("/dashboard/users", [UserController::class, 'index'])->name("dashboard.users");
Route::get("/dashboard/users/edit/{id}", [UserController::class, 'edit'])->name("dashboard.users.edit");
Route::post("/dashboard/users/update", [UserController::class, 'update'])->name("dashboard.users.update");

Route::resource('/cart', CartController::class);

Route::post("/checkout", [CheckoutController::class, "index"])->name("checkout");
// Auth
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post("/login/handle", [LoginController::class, 'checkUser'])->name('login.handle');

Route::get("/register", function () {
    return view('auth.register');
})->name('register');

Route::post('register/handle', [RegisterController::class, 'createUser'])->name('register.handle');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
