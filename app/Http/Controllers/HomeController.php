<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $blogs = Blog::all();
        return view('home',compact('categories','blogs'));
    }
    public function contact()
    {
        $categories = collect(Category::all());
        return view('contact',compact('categories'));
    }
    public function category()
    {
        $categories = collect(Category::all());
        return view('category',compact('categories'));
    }
    public function blogMore($id)
    {
        $categories = collect(Category::all());
        $blog = Blog::where('id',Crypt::decryptString($id))->first();
        return view('single',compact('categories','blog'));
    }
    public function categoriesWise($id)
    {
        $categories = collect(Category::all());
        $blogs = Blog::where('category',Crypt::decryptString($id))->get();
        return view('category-wise',compact('categories','blogs'));
    }
}
