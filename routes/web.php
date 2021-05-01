<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\customercontroller;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\MerchantPermissionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Mail\NewAdminWelcomEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/general', function () {
//     return view('cms.sampels.general');
// });

    Route::prefix('cms/admin')->middleware('auth:admin,user','verified')->group(function(){
        Route::view('/','cms.dashbord')->name('cms.dashbord');
    });

Route::prefix('cms/admin')->middleware('auth:admin','verified')->group(function(){

    Route::resource('/merchant', MerchantController::class);
    Route::resource('/car', CarController::class);
    Route::resource('/customer', customercontroller::class);

    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);

    Route::resource('/merchants.permissions', MerchantPermissionController::class);

    Route::get('edit-password',[AdminAuthController::class,'editPassword'])->name('auth.edit-password');
    Route::put('update-password',[AdminAuthController::class,'updatePassword'])->name('auth.update-password');

    Route::get('edit-profile',[AdminAuthController::class,'editProfile'])->name('auth.edit-profile');
    Route::put('update-profile',[AdminAuthController::class,'updateProfile'])->name('auth.update-profile');

    Route::get('logout',[AdminAuthController::class,'logout'])->name('auth.logout');

});


Route::prefix('cms/user')->middleware('auth:user','verified')->group(function(){

    Route::resource('/merchant', MerchantController::class);
    Route::resource('/car', CarController::class);
    Route::resource('/customer', customercontroller::class);


    Route::get('edit-password',[AdminAuthController::class,'editPassword'])->name('auth.edit-password');
    Route::put('update-password',[AdminAuthController::class,'updatePassword'])->name('auth.update-password');

    Route::get('edit-profile',[AdminAuthController::class,'editProfile'])->name('auth.edit-profile');
    Route::put('update-profile',[AdminAuthController::class,'updateProfile'])->name('auth.update-profile');

    Route::get('logout-user',[UserAuthController::class,'logout'])->name('auth-user.logout');

});

Route::prefix('cms/admin')->middleware('guest:admin')->group(function () {
    Route::get('login',[AdminAuthController::class, 'showLogin'])->name('auth.login.view');
    Route::post('login',[AdminAuthController::class, 'login'])->name('auth.login');
});

Route::prefix('cms/user')->middleware('guest:user')->group(function () {
    Route::get('login',[UserAuthController::class, 'showLogin'])->name('auth-user.login.view');
    Route::post('login',[UserAuthController::class, 'login'])->name('auth-user.login');
});

// Route::get('testemail',function(){
//     return new NewAdminWelcomEmail();
// });


Route::get('/email/verify', function () {
    // return view('auth.verify-email');
    return "Your email is not verified";
})->middleware('auth:admin')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/cms/admin');
})->middleware(['auth:admin', 'signed'])->name('verification.verify');
