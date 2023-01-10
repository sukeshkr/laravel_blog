<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('contact',[HomeController::class,'contact'])->name('contact');
Route::get('/categories',[HomeController::class,'category'])->name('home.category');
Route::get('/blog-more',[HomeController::class,'blogMore'])->name('blog.more');
