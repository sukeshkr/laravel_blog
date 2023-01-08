<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashBoardController;
use App\Http\Controllers\admin\LoginController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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


Route::get('/', [LoginController::class,'index'])->name('login');
Route::post('/', [LoginController::class,'postLogin'])->name('post.login');

Route::get('/dashboard',[DashBoardController::class,'index'])->name('dashboard')->middleware('verified');
Route::get('register', [AuthController::class,'register'])->name('register');
Route::post('/register', [AuthController::class,'postRegister'])->name('post.register');
//email verification
Route::get('/email/verify', function () {
    return view('admin.auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('admin/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');
//email verify end

//forgot password
Route::get('/forgot-password',function() {
    return view('admin.auth.forgot-password');
})->name('password.request');

Route::post('forgot',[AuthController::class,'postForgot'])->name('password.email');

Route::get('/reset-password/{token}',function($token){
    return view('admin.auth.reset-password',['token'=>$token]);
})->name('password.reset');

Route::post('password-update',[AuthController::class,'passwordUpdate'])->name('password.update');
//forgot password end

Route::get('category', [CategoryController::class,'index'])->name('category');
Route::post('category', [CategoryController::class,'postCategory'])->name('post.category');


Route::get('logout', [AuthController::class,'logout'])->name('user.logout');



