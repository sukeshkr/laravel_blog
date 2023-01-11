<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $datas = Category::select('id','name')->get();
        return view('admin.blog.blog',compact('datas'));
    }
    public function postBlog(Request $request)
    {
        $request->validate([
            'post_date'=>'required',
            'title'=>'required',
            'category'=>'required',
            'file'=>'required',
            'description'=>'required',
        ]);

        $file_name = $request->file('file')->hashName();
        $request->file->move(public_path('blog'),$file_name);

        $data = Blog::create([
            'post_date'=>$request->post_date,
            'title'=>$request->title,
            'category'=>$request->category,
            'description'=>$request->description,
            'file'=>$file_name,
        ]);
        if($data) {
            return redirect()->back()->with('sucess','Created Sucessfully');
        }
        else {

            return redirect()->back()->with('error','Something went wrong');
        }
    }
    public function blogList()
    {
        return view('admin.blog.blog-list');
    }
    public function blogFetch(Request $request)
    {
        $col_order = ['id','title'];
        $total_data = Blog::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $col_order[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value'))) {
            $post = Blog::offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $total_filtered = Blog::count();
        }
        else {
            $search = $request->input('search.value');

            $post = Blog::where('id','like',"%{$search}%")
                ->orWhere('title','like',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $total_filtered = Blog::where('id','like',"%{$search}%")
                ->orWhere('title','like',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->count();
        }
        $data = array();
        if($post) {
            $slno = 1;
            foreach($post as $row) {

                $dataedit =  route('blog.edit',Crypt::encryptString($row->id));
                $img_path = asset("blog/$row->file");
                $nest['slno'] = $slno++;
                $nest['date'] = $row->post_date;
                $nest['title'] = $row->title;
                $nest['category'] = $row->categorys->name;
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
    public function blogEdit($id)
    {
        $data = Blog::where('id',Crypt::decryptString($id))->first();
        $categories = Category::select('id','name')->get();
        return view('admin.blog.blog-edit',compact('data','categories'));
    }
    public function blogUpdate(Request $request)
    {
        $data = $request->validate([
            'title'=> 'required',
            'category'=> 'required',
            'description'=>'required',
        ]);

        $id = $request->id;

        if($request->file('file')) {

            $file_name  = $request->file('file')->hashName();
            $image_path = $request->file->move(public_path('blog'),$file_name);
            $data['file'] = $file_name;
        }

        $res = Blog::where('id',$id)->update($data);

        return redirect()->back()->with('sucess','Updated Successsfully');

    }

    public function blogDelete()
    {
        if(request()->ajax()) {

            $id = request()->rowid;
           $res = Blog::destroy($id);
           return $res;
        }


    }
}
