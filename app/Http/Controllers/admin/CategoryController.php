<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.category');
    }
    public function postCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'file'=>'required',
            'description'=>'required',
        ]);

        $file_name  = $request->file('file')->hashName();

        $image_path = $request->file->move(public_path('category'),$file_name);

        $data = Category::create([
            'name'=> $request->name,
            'file'=> $file_name,
            'description'=>$request->description,
        ]);

        if($data) {
            return redirect()->back()->with('sucess','Created Sucessfully');
        }
        else {
            return redirect()->back()->with('error','Something went wrong');
        }
    }
    public function categoryList()
    {
        return view('admin.category.category-list');
    }
    public function categoryFetch(Request $request)
    {
        $col_order = ['id','name'];
        $total_data = Category::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $col_order[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value'))) {
            $post = Category::offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $total_filtered = Category::count();
        }
        else {
            $search = $request->input('search.value');

            $post = Category::where('id','like',"%{$search}%")
                ->orWhere('name','like',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $total_filtered = Category::where('id','like',"%{$search}%")
                ->orWhere('name','like',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->count();
        }
        $data = array();
        if($post) {
            $slno = 1;
            foreach($post as $row) {

                $dataedit =  route('category.edit',Crypt::encryptString($row->id));
                $img_path = asset("category/$row->file");
                $nest['slno'] = $slno++;
                $nest['name'] = $row->name;
                $nest['description'] = Str::of($row->description)->limit(20,' ...');
                $nest['image'] = "<img width='100' height='60' src='{$img_path}' alt='blog'>";
                $nest['actions'] = "<a href='{$dataedit}' class='btn btn-primary btn-sm'><i class='fa fa-edit' aria-hidden='true'></i></a>
                <a data-toggle='modal' data-id='{$row->id}' data-target='#del-modal' class='btn btn-danger btn-sm' href='#'><i class='fa  fa-trash' aria-hidden='true'></i></a>";
                $data[] = $nest;
            }
        }
        $json = array(
            'draw' => intval($request->input('draw')),
            'recordsTotal'=>intval($total_data),
            'recordsFiltered'=>intval($total_filtered),
            'data'=>$data,
        );
        echo json_encode($json);
    }
    public function categoryEdit($id)
    {
        $data = Category::where('id', Crypt::decryptString($id))->first();
        return view('admin.category.category-edit',compact('data'));
    }
    public function categoryUpdate(Request $request)
    {
        $data = $request->validate([
            'name'=> 'required',
            'description'=>'required',
        ]);

        $id = $request->id;

        if($request->file('file')) {

            $file_name  = $request->file('file')->hashName();
            $image_path = $request->file->move(public_path('category'),$file_name);
            $data['file'] = $file_name;
        }

        $res = Category::where('id',$id)->update($data);

        return redirect()->back()->with('sucess','Updated Successsfully');
    }
    public function categoryDelete(Request $request)
    {
        if ($request->ajax()) {

            $id = $request->rowid;
            $res = Category::destroy($id);
            return $res;
        }
    }
}
