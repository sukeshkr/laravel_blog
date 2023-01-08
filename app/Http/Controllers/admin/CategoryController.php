<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category');
    }
    public function postCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'file'=>'required',
            'description'=>'required',
        ]);

        $imageName = time().'.'.$request->file->extension();

        return $imageName;

        $image_path = $request->file('file')->store('file','public');

        return $image_path;
    }
}
