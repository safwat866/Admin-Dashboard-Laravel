<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductsBulkDelete;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyCheckoutController;
use \App\Http\Controllers\VerifyPayment;
use App\Http\Middleware\auth;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isAuthentecated;
use Illuminate\Support\Facades\Route;

// Main Routes
Route::middleware([auth::class])->group(function () {
    Route::get("/", [IndexController::class, "index"])->name("home");
    Route::resource('/cart', CartController::class);
    Route::post("/checkout", [CheckoutController::class, "index"])->name("checkout");
    Route::get("/verify-chekcout", [VerifyCheckoutController::class, "index"])->name("verify-checkout");
    // access to dashboard
    Route::middleware([isAdmin::class])->group(function () {
        Route::get('/dashboard', [AdminController::class, "index"])->name('dashboard');
        Route::resource("/dashboard/products", ProductsController::class);
        Route::post("/dashboard/products/bulk-delete", [ProductsController::class, "bulkDelete"])->name("products-bulk-delete");
        Route::resource("/dashboard/users", UserController::class);
        Route::post("/dashboard/users/bulk-delete", [UserController::class, "bulkDelete"])->name("users-bulk-delete");
        Route::get("/dashboard/profile" , function () {return view("pages.user_profile");})->name("profile");
        Route::post("/dashboard/profile", [ProfileController::class, "index"])->name("profile");
    });
});

// Auth
Route::middleware([isAuthentecated::class])->group(function () {
    Route::get("/register", [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
    Route::get('/login', [LoginController::class, "showLoginForm"])->name('login');
    Route::post("/login", [LoginController::class, 'login'])->name('login.submit');
});

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');