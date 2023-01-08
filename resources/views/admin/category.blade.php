@extends('admin.layout.app')
@section('body')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Category</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <form action="{{route('post.category')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        @error('name')
                        <div class="text-danger text-center">{{$message}}</div>
                        @enderror
                        @error('file')
                        <div class="text-danger text-center">{{$message}}</div>
                        @enderror
                        @error('description')
                        <div class="text-danger text-center">{{$message}}</div>
                        @enderror
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Category Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="first-name" name="name" class="form-control @error('name') is-invalid @enderror">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Category Image<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="file" id="first-name" name="file" class="form-control @error('name') is-invalid @enderror" id="formFileDisabled">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Description</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <textarea id="message" name="description"  class="form-control @error('name') is-invalid @enderror" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button class="btn btn-primary" type="button">Cancel</button>
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

