<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Sleep;
//use Inertia\Inertia;

/*Route::get('/', function (){
	//Sleep(1);
	return Inertia::render('Home');
})->name('home');*/
Route::inertia('/','Home')->name('home');

Route::inertia('/register','Auth/Register')->name('register');
Route::post('/register',[AuthController::class,'register']);
