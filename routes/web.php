<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Sleep;
use Inertia\Inertia;

/*Route::get('/', function (){
	//Sleep(1);
	return Inertia::render('Home');
})->name('home');*/
Route::inertia('/','Home')->name('home');

Route::inertia('/about','About')->name('about');