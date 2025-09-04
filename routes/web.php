<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HeadController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMemberController;
use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\AlreadyIn;
use App\Http\Middleware\BlockDirectAccess;

Route::get('/login',[AuthController::class,'login'])->middleware('already.in');
Route::get('/register',[AuthController::class,'register']);
Route::post('/register-user', [AuthController::class, 'registerUser'])->name('register-user');
Route::post('/login-user', [AuthController::class, 'loginUser'])->name('login-user');

Route::get('/dashboard',[AuthController::class,'dashboard'])->middleware('auth.check');
Route::get('/logout',[AuthController::class,'logout']);
Route::view('/','head')->name('head');



/// Head section
Route::post('/head',[HeadController::class,'post_data']);




/// MEMBERS SECTION
Route::get('/familySection/{id}',[HeadController::class,'familySection'])->name('familySection')->middleware('block.direct');
Route::post('/add-member/{id}',[HeadController::class,'addMember'])->name('addMember');
Route::get('logout-member/{id}',[HeadController::class,'logoutMember'])->name('logoutMember');





/// RESET PASSWORD SECTION
Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPasswordPost'])->name('forgot.password.Post');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password');

Route::post('/reset-password', [ForgotPasswordController::class, 'resetPasswordPost'])->name('reset.password.post');


/// ADMIN SECTION
Route::resource('/admin', AdminController::class)->middleware('auth.check');
Route::get('/search',[AdminController::class,'search'])->name('search');

    /// Admin member section
    Route::resource('/admin-member', AdminMemberController::class)->middleware('auth.check');
    Route::get('/adminfamilySection/{id}',[AdminMemberController::class,'familySection'])->name('adminFamilySection');
    Route::post('/admin.add-member/{id}',[AdminMemberController::class,'addMember'])->name('adminAddMember');


