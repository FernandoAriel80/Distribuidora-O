<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
//use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Models\Type;
use Inertia\Inertia;

/* Route::middleware('auth')->group(function(){
    Route::post('/logout',[AuthController::class,'logout'])->name('auth.logout');

    Route::inertia('/admin', 'Admin/Menu')->name('admin.menu');

    Route::inertia('/create', 'Admin/Products/Index')->name('products.index');
    Route::inertia('/create', 'Admin/Products/Create')->name('products.create');
    Route::get('/create',[ProductController::class, 'index']);
    Route::post('/create',[ProductController::class, 'store']);

    
    // Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

   
}); */

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::prefix('admin')->group(function () {
        Route::inertia('/', 'Admin/Menu')->name('admin.menu');

        Route::prefix('products')->group(function () {
            //Route::inertia('/create', 'Admin/Products/Create')->name('products.create'); 
            Route::get('/', [ProductController::class, 'index'])->name('products.index'); 
            Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

            Route::get('/create', [ProductController::class, 'create'])->name('products.create');
            Route::post('/create', [ProductController::class, 'store'])->name('products.store');

            Route::inertia('/edit', 'Admin/Products/Edit')->name('products.edit'); 
            Route::get('/edit', [ProductController::class, 'edit'])->name('products.edit');
            Route::post('/edit/{id}', [ProductController::class, 'update']);

        });
        Route::prefix('employees')->group(function(){
            Route::get('/',[EmployeeController::class, 'index'])->name('employees.index');
            Route::post('/create', [EmployeeController::class,'store'])->name('employees.store');
        });
    });
});



Route::inertia('/','Home')->name('home');

Route::middleware('guest')->group(function(){
    Route::inertia('/register','Auth/Register')->name('auth.register');
    Route::post('/register',[AuthController::class,'register']);
    
    Route::inertia('/login','Auth/Login')->name('auth.login');
    Route::post('/login',[AuthController::class,'login']);

   /*  Route::inertia('/create','Admin/Products/Create'); */

});


