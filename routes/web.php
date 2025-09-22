<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HeadController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMemberController;
use App\Http\Controllers\CityStateController;

Route::get('/login', [AuthController::class, 'login'])->middleware('already.in');
Route::get('/register', [AuthController::class, 'register'])->middleware('auth.check');
Route::post('/register-user', [AuthController::class, 'registerUser'])->name('register-user');
Route::post('/login-user', [AuthController::class, 'loginUser'])->name('login-user');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth.check');
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/dashboard/admin-profile', [AuthController::class, 'adminProfile'])->middleware('auth.check');

/// Activate Head
Route::post('/dashboard/admin-profile/activate', [AuthController::class, 'activateHead'])->name('activate.head')->middleware('auth.check');
Route::post('/dashboard/admin-profile/deactivateHead', [AuthController::class, 'deactivateHead'])->name('deactivateHead.head')->middleware('auth.check');

/// AJAX routes for member activation
Route::get('/dashboard/admin-profile/get-inactive-members/{headId}', [AuthController::class, 'getInactiveMembers'])->name('get.inactive.members')->middleware('auth.check');
Route::post('/dashboard/admin-profile/activate-selected', [AuthController::class, 'activateSelectedMembers'])->name('activate.selected.members')->middleware('auth.check');

/// Head section
Route::post('/head', [HeadController::class, 'post_data']);
Route::get('/headview', [HeadController::class, 'headview'])->name('head');
Route::get('/get-cities/{stateId}', [HeadController::class, 'getCities']);
Route::get('/', [HeadController::class, 'dashboard']);




/// MEMBERS SECTION
Route::get('/familySection/{id}', [HeadController::class, 'familySection'])->name('familySection')->middleware('block.direct');
Route::post('/add-member/{id}', [HeadController::class, 'addMember'])->name('addMember');
Route::get('logout-member/{id}', [HeadController::class, 'logoutMember'])->name('logoutMember');





/// RESET PASSWORD SECTION
Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPasswordPost'])->name('forgot.password.Post');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password');

Route::post('/reset-password', [ForgotPasswordController::class, 'resetPasswordPost'])->name('reset.password.post');


/// ADMIN SECTION
Route::resource('/admin', AdminController::class)->middleware('auth.check');
Route::get('/allmembers', [AdminController::class, 'allMembers'])->name('admin.members')->middleware('auth.check');
Route::get('/allmembers/{id}', [AdminController::class, 'viewMemberDetails'])->name('admin.viewMemberDetails')->middleware('auth.check');
Route::get('/download/{id}', [AdminController::class, 'print_pdf'])->name('download');
Route::get('pdf/heads/download/all', [AdminController::class, 'print_all_pdf'])->name('download_all');
Route::get('excel/heads/download/all', [AdminController::class, 'export'])->name('download_excel_all');
Route::get('/search', [AdminController::class, 'search'])->name('search');
Route::get('/delete/{id}', [AdminController::class, 'delete'])->name('delete');

/// Admin member section
Route::resource('/admin-member', AdminMemberController::class)->middleware('auth.check');
Route::get('/adminfamilySection/{id}', [AdminMemberController::class, 'familySection'])->name('adminFamilySection');
Route::get('/pdf/members/download/all', [AdminMemberController::class, 'print_member_all_pdf'])->name('download_all_members');
Route::get('/excel/members/download/all', [AdminMemberController::class, 'export'])->name('download_excel_all_members');
Route::get('/member/delete/{id}', [AdminMemberController::class, 'delete'])->name('member.delete');
Route::post('/admin.add-member/{id}', [AdminMemberController::class, 'addMember'])->name('adminAddMember');

/// STATE AND CITY SECTION
Route::resource('/state-city', CityStateController::class)->middleware('auth.check');
Route::match(['get', 'post'], 'admin/state-city/states', [CityStateController::class, 'stateindex'])->name('state.index')->middleware('auth.check');

//* FOR STATE
Route::get('admin/state-city/editstate/{id}', [CityStateController::class, 'editstate'])->name('state.edit');
Route::put('admin/state-city/updatestate/{id}', [CityStateController::class, 'updatestate'])->name('state.update');
Route::get('admin/state-city/deletestate/{id}', [CityStateController::class, 'deletestate'])->name('state.delete');

//* FOR CITY
Route::get('admin/state-city/editcity/{id}', [CityStateController::class, 'editcity'])->name('city.edit');
Route::put('admin/state-city/updatecity/{id}', [CityStateController::class, 'updatecity'])->name('city.update');
Route::get('admin/state-city/deletecity/{id}', [CityStateController::class, 'deletecity'])->name('city.delete');


Route::get('admin/state-city/city', [CityStateController::class, 'cityindex'])->name('city.index')->middleware('auth.check');
Route::get('admin/state-city/createcity', [CityStateController::class, 'createCity'])->name('create.city')->middleware('auth.check');
Route::get('admin/state-city/createState', [CityStateController::class, 'createState'])->name('create.state')->middleware('auth.check');
Route::post('admin/state-city/storecity', [CityStateController::class, 'storeCity'])->name('store.city');
Route::post('admin/state-city/storestate', [CityStateController::class, 'storestate'])->name('store.state');
Route::get('admin/state-city/showcity/{id}', [CityStateController::class, 'showcity'])->name('show.city');
Route::get('admin/state-city/createViaShowCity/{id}', [CityStateController::class, 'createViaShowCity'])->name('show.createViaShowCity');
