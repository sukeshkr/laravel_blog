<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashBoardController;
use App\Http\Controllers\admin\LoginController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', [LoginController::class,'index'])->name('login');
Route::post('/', [LoginController::class,'postLogin'])->name('post.login');

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
Route::group(['middleware'=>['auth','verified']] ,function() {

    Route::get('/dashboard',[DashBoardController::class,'index'])->name('dashboard');

    Route::get('category', [CategoryController::class,'index'])->name('category');
    Route::post('category', [CategoryController::class,'postCategory'])->name('post.category');
    Route::get('category-list', [CategoryController::class,'categoryList'])->name('category.list');
    Route::get('category-fetch',[CategoryController::class,'categoryFetch'])->name('category.fetch');
    Route::get('category-delete',[CategoryController::class,'categoryDelete'])->name('category.delete');
    Route::get('category-edit/{id}',[CategoryController::class,'categoryEdit'])->name('category.edit');
    Route::post('category-update',[CategoryController::class,'categoryUpdate'])->name('category.update');

    Route::get('banner', [BannerController::class,'index'])->name('banner');
    Route::post('banner', [BannerController::class,'postBanner'])->name('post.banner');
    Route::get('banner-list', [BannerController::class,'bannerList'])->name('banner.list');
    Route::get('banner-fetch',[BannerController::class,'bannerFetch'])->name('banner.fetch');
    Route::get('banner-delete',[BannerController::class,'bannerDelete'])->name('banner.delete');
    Route::get('banner-edit/{id}',[BannerController::class,'bannerEdit'])->name('banner.edit');
    Route::post('banner-update',[BannerController::class,'bannerUpdate'])->name('banner.update');

    Route::get('blog', [BlogController::class,'index'])->name('blog');
    Route::post('blog', [BlogController::class,'postBlog'])->name('post.blog');
    Route::get('blog-list', [BlogController::class,'blogList'])->name('blog.list');
    Route::get('blog-fetch',[BlogController::class,'blogFetch'])->name('blog.fetch');
    Route::get('blog-delete',[BlogController::class,'blogDelete'])->name('blog.delete');
    Route::get('blog-edit/{id}',[BlogController::class,'blogEdit'])->name('blog.edit');
    Route::post('blog-update',[BlogController::class,'blogUpdate'])->name('blog.update');

    Route::get('logout', [AuthController::class,'logout'])->name('user.logout');

});
