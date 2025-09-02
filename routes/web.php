<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HeadController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\AlreadyIn;

Route::get('/login',[AuthController::class,'login'])->middleware(AlreadyIn::class);
Route::get('/register',[AuthController::class,'register']);
Route::post('/register-user', [AuthController::class, 'registerUser'])->name('register-user');
Route::post('/login-user', [AuthController::class, 'loginUser'])->name('login-user');

Route::get('/dashboard',[AuthController::class,'dashboard'])->middleware(AuthCheck::class);
Route::get('/logout',[AuthController::class,'logout']);
Route::view('/','head')->name('head');



/// Head section
Route::post('/head',[HeadController::class,'post_data']);




/// MEMBERS SECTION
Route::get('/familySection/{id}',[HeadController::class,'familySection'])->name('familySection');
Route::post('/add-member/{id}',[HeadController::class,'addMember'])->name('addMember');





/// RESET PASSWORD SECTION
Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPasswordPost'])->name('forgot.password.Post');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password');

Route::post('/reset-password', [ForgotPasswordController::class, 'resetPasswordPost'])->name('reset.password.post');


