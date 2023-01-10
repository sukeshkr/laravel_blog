<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index()
    {
        return view('admin.banner.banner');
    }
    public function postBanner(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'file'=>'required',
        ]);

        $file_name  = $request->file('file')->hashName();

        $image_path = $request->file->move(public_path('banner'),$file_name);

        $data = Banner::create([
            'name'=> $request->name,
            'file_name'=> $file_name,
        ]);

        if($data) {
            return redirect()->back()->with('sucess','Created Sucessfully');
        }
        else {
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function bannerList()
    {
        return view('admin.banner.banner-list');
    }
    public function bannerFetch(Request $request)
    {
        $col_order = ['id','name'];
        $total_data = Banner::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $col_order[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {

            $post = Banner::offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $total_filtered = Banner::count();
        }
        else {

            $search = $request->input('search.value');

            $post = Banner::where('id','like',"%{$search}%")
            ->orWhere('name','like',"%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->get();

            $total_filtered = Banner::where('id','like',"%{$search}%")
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

                $data_edit =  route('banner.edit',Crypt::encryptString($row->id));
                $img_path = asset("banner/$row->file_name");

                $nest['slno'] = $slno++;
                $nest['name'] = $row->name;
                $nest['image'] = "<img width='100' height='60' src='{$img_path}' alt='blog'>";
                $nest['actions'] = "<a href='{$data_edit}' class='btn btn-primary btn-sm'><i class='fa fa-edit' aria-hidden='true'></i></a>
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

    public function bannerEdit($id)
    {
        $data = Banner::where('id', Crypt::decryptString($id))->first();
        return view('admin.banner.banner-edit',compact('data'));
    }

    public function bannerUpdate(Request $request)
    {
        $data = $request->validate([
            'name'=> 'required',
        ]);

        $id = $request->id;

        if($request->file('file')) {

            $file_name  = $request->file('file')->hashName();
            $image_path = $request->file->move(public_path('banner'),$file_name);
            $data['file_name'] = $file_name;
        }

        $res = Banner::where('id',$id)->update($data);

        return redirect()->back()->with('sucess','Updated Successsfully');
    }

    public function bannerDelete(Request $request)
    {
        if ($request->ajax()) {

            $id = $request->rowid;
            $res = Banner::destroy($id);
            return $res;
        }
    }
}
