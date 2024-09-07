<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;
use App\Models\Type;

Route::middleware('auth')->group(function(){
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');

 

   /*  Route::inertia('/create','Admin/Products/Create')->name('create'); */
  // Route::inertia('/create','Admin/Products/Create')->name('Create');
   Route::get('/create',[ProductController::class,  'index'])->name('create');;
   
});


Route::inertia('/','Home')->name('home');

Route::middleware('guest')->group(function(){
    Route::inertia('/register','Auth/Register')->name('register');
    Route::post('/register',[AuthController::class,'register']);
    
    Route::inertia('/login','Auth/Login')->name('login');
    Route::post('/login',[AuthController::class,'login']);

   /*  Route::inertia('/create','Admin/Products/Create'); */

});


