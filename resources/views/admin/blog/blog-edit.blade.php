@extends('admin.layout.app')
@section('body')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Blog</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <form action="{{route('blog.update')}}" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        @error('title')
                        <div class="text-danger text-center">{{$message}}</div>
                        @enderror
                        @error('category')
                        <div class="text-danger text-center">{{$message}}</div>
                        @enderror
                        @error('file')
                        <div class="text-danger text-center">{{$message}}</div>
                        @enderror
                        @error('description')
                        <div class="text-danger text-center">{{$message}}</div>
                        @enderror
                        @if (session('sucess'))
                        <div class="text-success text-center">{{session('sucess')}}</div>
                        @endif
                        <input type="hidden" name='id' value="{{$data->id}}">
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Post Date <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input disabled  value="{{old('post_date',$data->post_date)}}" class="date-picker form-control @error('post_date') is-invalid @enderror" placeholder="dd-mm-yyyy" type="text" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                    <script>
                                        function timeFunctionLong(input) {
                                            setTimeout(function() {
                                                input.type = 'text';
                                            }, 60000);
                                        }
                                    </script>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Title<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" name="title" value="{{old('title',$data->title)}}" id="first-name" class="form-control @error('title') is-invalid @enderror">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Category Select</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control @error('category') is-invalid @enderror" name='category'>
                                        <option value="">Choose option</option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}" @selected(old('category',$data->category) == $category->id)>{!!$category->name!!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Image<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <img width="120" height="70" src="{{asset('blog/'.$data->file.'')}}" alt="blog">
                                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" id="formFileDisabled">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Description</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <textarea name="description" id="message" class="form-control @error('description') is-invalid @enderror" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10">{{old('description',$data->description)}}</textarea>
                                </div>
                            </div>


                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a class="btn btn-primary" href="{{route('blog.list')}}">Cancel</a>
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

