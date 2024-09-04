<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');

    Route::inertia('/create','Admin/Products/Create')->name('create');
    Route::post('/create',[AuthController::class,'create']);   
});

Route::inertia('/','Home')->name('home');

Route::middleware('guest')->group(function(){
    Route::inertia('/register','Auth/Register')->name('register');
    Route::post('/register',[AuthController::class,'register']);
    
    Route::inertia('/login','Auth/Login')->name('login');
    Route::post('/login',[AuthController::class,'login']);
});


