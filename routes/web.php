<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HeadController;
use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\AlreadyIn;

Route::get('/login',[AuthController::class,'login'])->middleware(AlreadyIn::class);
Route::get('/register',[AuthController::class,'register']);
Route::post('/register-user', [AuthController::class, 'registerUser'])->name('register-user');
Route::post('/login-user', [AuthController::class, 'loginUser'])->name('login-user');

Route::get('/dashboard',[AuthController::class,'dashboard'])->middleware(AuthCheck::class);
Route::get('/logout',[AuthController::class,'logout']);
Route::view('/','head')->name('head');



//head section
Route::post('/head',[HeadController::class,'post_data']);



