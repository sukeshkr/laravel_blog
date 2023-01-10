@extends('admin.layout.app')
@section('body')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Banner</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <form enctype="multipart/form-data" action="{{route('banner.update')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        @error('name')
                        <div class="text-danger text-center">{{$message}}</div>
                        @enderror
                        @error('file')
                        <div class="text-danger text-center">{{$message}}</div>
                        @enderror
                        @if (session('sucess'))
                        <div class="text-success text-center">{{session('sucess')}}</div>
                        @endif
                        @if (session('error'))
                        <div class="text-success text-center">{{session('error')}}</div>
                        @endif
                        <input type="hidden" name="id" value="{{$data->id}}">
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Banner Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="first-name" value="{{old('name',$data->name)}}" name="name" class="form-control @error('name') is-invalid @enderror">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Banner Image<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <img width="120" height="70" src="{{asset('banner/'.$data->file_name.'')}}" alt="blog">
                                    <input type="file" id="first-name" name="file" class="form-control @error('file') is-invalid @enderror" id="formFileDisabled">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a class="btn btn-warning" href="{{route('banner')}}">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
@endsection

