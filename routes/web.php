<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('contact',[HomeController::class,'contact'])->name('contact');
Route::get('/categories',[HomeController::class,'category'])->name('home.category');
Route::get('/blog-more/{id}',[HomeController::class,'blogMore'])->name('blog.more');
Route::get('/categories-wise/{id}',[HomeController::class,'categoriesWise'])->name('categories.wise');
