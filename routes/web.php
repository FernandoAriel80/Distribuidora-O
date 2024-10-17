<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// public routes
Route::inertia('/', 'Home')->name('home');
Route::get('/',[HomeController::class,'index'])->name('home.index');

Route::middleware('guest')->group(function(){
    Route::inertia('/register', 'Auth/Register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::prefix('admin')->group(function () {
        Route::inertia('/', 'Admin/Menu')->name('admin.menu');

        //only admin
        Route::middleware('is_admin:admin,super_admin')->group(function () {
            Route::prefix('products')->group(function () {
                Route::get('/', [ProductController::class, 'index'])->name('products.index');
                Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
                Route::get('/create', [ProductController::class, 'create'])->name('products.create');
                Route::post('/create', [ProductController::class, 'store'])->name('products.store');
                Route::inertia('/update', 'Admin/Products/Update')->name('products.update');
                Route::post('/update/{id}', [ProductController::class, 'update']);
            });
        });

        //only super admin
        Route::middleware('is_admin:super_admin')->group(function () {
            Route::prefix('employees')->group(function(){
                Route::get('/',[EmployeeController::class, 'index'])->name('employees.index');
                Route::post('/create', [EmployeeController::class,'store'])->name('employees.store');
                Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
                Route::post('/update/{id}', [EmployeeController::class, 'update']);
    
            });
        });

    });
});

