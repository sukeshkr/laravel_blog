<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\DashBoardController;
use App\Http\Controllers\admin\LoginController;

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

Route::get('/dashboard',[DashBoardController::class,'index'])->name('dashboard');
Route::get('register', [AuthController::class,'register'])->name('register');
Route::get('logout', [AuthController::class,'logout'])->name('logout');



