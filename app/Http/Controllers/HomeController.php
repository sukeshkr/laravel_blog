<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessContactMail;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

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
    public function contactMail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }

        $mailData = [
            'subject'=> $request->subject,
            'message'=> $request->message
        ];

        ProcessContactMail::dispatch($mailData);

        return response()->json(['success' => 'Email sent successfully.']);
    }
    public function category()
    {
        $categories = Category::paginate(4);
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
