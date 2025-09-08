<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HeadController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMemberController;
use App\Http\Controllers\CityStateController;
use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\AlreadyIn;
use App\Http\Middleware\BlockDirectAccess;

Route::get('/login',[AuthController::class,'login'])->middleware('already.in');
Route::get('/register',[AuthController::class,'register']);
Route::post('/register-user', [AuthController::class, 'registerUser'])->name('register-user');
Route::post('/login-user', [AuthController::class, 'loginUser'])->name('login-user');

Route::get('/dashboard',[AuthController::class,'dashboard'])->middleware('auth.check');
Route::get('/logout',[AuthController::class,'logout']);




/// Head section
Route::post('/head',[HeadController::class,'post_data']);
Route::get('/headview',[HeadController::class,'headview'])->name('head');
Route::get('/get-cities/{stateId}',[HeadController::class,'getCities']);
Route::get('/',[HeadController::class,'dashboard']);




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

/// STATE AND CITY SECTION
Route::resource('/state-city',CityStateController::class)->middleware('auth.check');
Route::match(['get','post'],'admin/state-city/states',[CityStateController::class,'stateindex'])->name('state.index');

//* FOR STATE
Route::get( 'admin/state-city/editstate/{id}', [CityStateController::class, 'editstate'])->name('state.edit');
Route::put( 'admin/state-city/updatestate/{id}', [CityStateController::class, 'updatestate'])->name('state.update');
Route::delete( 'admin/state-city/deletestate/{id}', [CityStateController::class, 'deletestate'])->name('state.delete');

//* FOR CITY
Route::get( 'admin/state-city/editcity/{id}', [CityStateController::class, 'editcity'])->name('city.edit');
Route::put( 'admin/state-city/updatecity/{id}', [CityStateController::class, 'updatecity'])->name('city.update');
Route::delete( 'admin/state-city/deletecity/{id}', [CityStateController::class, 'deletecity'])->name('city.delete');


Route::get('admin/state-city/city',[CityStateController::class,'cityindex'])->name('city.index');
Route::get('admin/state-city/createcity',[CityStateController::class,'createCity'])->name('create.city');
Route::get('admin/state-city/createState',[CityStateController::class,'createState'])->name('create.state');
Route::post('admin/state-city/storecity',[CityStateController::class,'storeCity'])->name('store.city');
Route::post('admin/state-city/storestate',[CityStateController::class,'storestate'])->name('store.state');
Route::match(['get','post'],'admin/state-city/showcity/{id}',[CityStateController::class,'showcity'])->name('show.city');


