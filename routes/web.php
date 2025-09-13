<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsBulkDelete;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RolesController;
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
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
    // access to dashboard
    
    Route::middleware(['permission:view dashboard'])->group(function () {
        Route::prefix('/dashboard')->group(function () {
            Route::get('/', [AdminController::class, "index"])->name('dashboard');
            Route::resource("/products", ProductsController::class);
            Route::post("/products/bulk-delete", [ProductsController::class, "bulkDelete"])->name("products-bulk-delete");
            Route::resource("/users", UserController::class);
            Route::resource("/admins", AdminsController::class);
            Route::post("/users/bulk-delete", [UserController::class, "bulkDelete"])->name("users-bulk-delete");
            Route::get("/profile", [ProfileController::class, "showProfileForm"])->name("profile");
            Route::post("/profile", [ProfileController::class, "index"])->name("profile");
            Route::resource("/roles", RolesController::class);
            Route::resource("/orders", OrdersController::class);
        });
    });
});

// Auth
Route::middleware([isAuthentecated::class])->group(function () {
    Route::get("/register", [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
    Route::get('/login', [LoginController::class, "showLoginForm"])->name('login');
    Route::post("/login", [LoginController::class, 'login'])->name('login.submit');
});