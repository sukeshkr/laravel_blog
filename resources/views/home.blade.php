@extends('layout.app')
@section('body')

<!-- Top News Slider Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="owl-carousel owl-carousel-2 carousel-item-3 position-relative">
            @foreach ($blogs->take(4) as $blog)
            <div class="d-flex">
                <img src="{{asset('blog/'.$blog->file)}}" style="width: 80px; height: 80px; object-fit: cover;">
                <div class="d-flex align-items-center bg-light px-3" style="height: 80px;">
                    <a class="text-secondary font-weight-semi-bold" href="">{{Str::of($blog->description)->limit(50 ,'(...)')}}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Top News Slider End -->


<!-- Main News Slider Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="owl-carousel owl-carousel-2 carousel-item-1 position-relative mb-3 mb-lg-0">
                    @foreach ($blogs->take(2)->shuffle() as $blog)
                    <div class="position-relative overflow-hidden" style="height: 435px;">
                        <img class="img-fluid h-100" src="{{asset('blog/'.$blog->file)}}" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-1">
                                <a class="text-white" href="">Technology</a>
                                <span class="px-2 text-white">/</span>
                                <a class="text-white" href="">{{$blog->postDate}}</a>
                            </div>
                            <a class="h2 m-0 text-white font-weight-bold" href="">{{$blog->title}}</a>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                    <h3 class="m-0">Categories</h3>
                    <a class="text-secondary font-weight-medium text-decoration-none" href="{{route('home.category')}}">View All</a>
                </div>
                @php
                    $random = $categories->random(fn ($categories)=> min(4,count($categories)))
                @endphp
                @foreach ($random->all() as $category)
                <div class="position-relative overflow-hidden" style="height: 80px;">
                    <img class="img-fluid w-100 h-100" src="{{asset('category/'.$category->file)}}" style="object-fit: cover;">
                    <a href="" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                        {{$category->name}}
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Main News Slider End -->


<!-- Featured News Slider Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Featured</h3>
            <a class="text-secondary font-weight-medium text-decoration-none" href="{{route('home.category')}}">View All</a>
        </div>
        <div class="owl-carousel owl-carousel-2 carousel-item-4 position-relative">
            @php
                $random = $blogs->random(fn ($blogs) => min(5, count($blogs)));
            @endphp
            @foreach ($random->all() as $blog)
            <div class="position-relative overflow-hidden" style="height: 300px;">
                <img class="img-fluid w-100 h-100" src="{{asset('blog/'.$blog->file)}}" style="object-fit: cover;">
                <div class="overlay">
                    <div class="mb-1" style="font-size: 13px;">
                        <a class="text-white" href="">Technology</a>
                        <span class="px-1 text-white">/</span>
                        <a class="text-white" href="">{{$blog->postDate}}</a>
                    </div>
                    <a class="h4 m-0 text-white" href="">{{$blog->title}}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
<!-- Featured News Slider End -->




<!-- Category News Slider Start -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            @foreach ($categories->take(4) as $category)
            <div class="col-lg-6 py-3">
                <div class="bg-light py-2 px-4 mb-3">
                    <h3 class="m-0">{{$category->name}}</h3>
                </div>
                <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                    @foreach ($category->blogs as $blog)
                    <div class="position-relative">
                        <img class="img-fluid w-50" src="{{asset('blog/'.$blog->file)}}" style="object-fit: cover;">
                        <div class="overlay position-relative bg-light">
                            <div class="mb-2" style="font-size: 13px;">
                                <a href="">{{$blog->title}}</a>
                                <span class="px-1">/</span>
                                <span>{{$blog->postDate}}</span>
                            </div>
                            <a class="h4 m-0" href="">Sanctus amet sed ipsum lorem</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
<!-- Category News Slider End -->


<!-- News With Sidebar Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Popular</h3>
                        </div>
                    </div>
                    @foreach ($blogs->take(-4) as $blog)
                    <div class="col-lg-6">
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-50" src="{{asset('blog/'.$blog->file)}}" style="object-fit: cover;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 14px;">
                                    <a href="">Technology</a>
                                    <span class="px-1">/</span>
                                    <span>{{$blog->postDate}}</span>
                                </div>
                                <a class="h4" href="">{{$blog->title}}</a>
                                <p class="m-0">{{Str::of($blog->description)->limit(65,'(...)')}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mb-3 pb-3">
                    <a href=""><img class="img-fluid w-100" src="img/ads-700x70.jpg" alt=""></a>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Latest</h3>
                        </div>
                    </div>
                    @foreach ($blogs->take(4) as $blog)
                    <div class="col-lg-6">
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-50" src="{{asset('blog/'.$blog->file)}}" style="object-fit: cover;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 14px;">
                                    <a href="">Technology</a>
                                    <span class="px-1">/</span>
                                    <span>{{$blog->postDate}}</span>
                                </div>
                                <a class="h4" href="">{{$blog->title}}</a>
                                <p class="m-0">{{Str::of($blog->description)->limit(65,'(...)')}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-4 pt-3 pt-lg-0">
                <!-- Social Follow Start -->
                <div class="pb-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Follow Us</h3>
                    </div>
                    <div class="d-flex mb-3">
                        <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #39569E;">
                            <small class="fab fa-facebook-f mr-2"></small><small>14345 Fans</small>
                        </a>
                        <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #52AAF4;">
                            <small class="fab fa-twitter mr-2"></small><small>4345 Followers</small>
                        </a>
                    </div>
                    <div class="d-flex mb-3">
                        <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #0185AE;">
                            <small class="fab fa-linkedin-in mr-2"></small><small>1545 Connects</small>
                        </a>
                        <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #C8359D;">
                            <small class="fab fa-instagram mr-2"></small><small>1845 Followers</small>
                        </a>
                    </div>
                    <div class="d-flex mb-3">
                        <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #DC472E;">
                            <small class="fab fa-youtube mr-2"></small><small>1875 Subscribers</small>
                        </a>
                        <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #1AB7EA;">
                            <small class="fab fa-vimeo-v mr-2"></small><small>1255 Followers</small>
                        </a>
                    </div>
                </div>
                <!-- Social Follow End -->

                <!-- Newsletter Start -->
                <div class="pb-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Newsletter</h3>
                    </div>
                    <div class="bg-light text-center p-4 mb-3">
                        <p>Send mail To Us for the latest news, updates relating to your products and services</p>
                        <div class="input-group" style="width: 100%;">
                            <input type="text" class="form-control form-control-lg" placeholder="Your Email">
                            <div class="input-group-append">
                                <button class="btn btn-primary">Sign Up</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Newsletter End -->

                <!-- Ads Start -->
                <div class="mb-3 pb-3">
                    <a href=""><img class="img-fluid" src="img/news-500x280-4.jpg" alt=""></a>
                </div>
                <!-- Ads End -->

                <!-- Popular News Start -->
                <div class="pb-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Tranding</h3>
                    </div>
                    @php
                        $random = $blogs->random(fn ($blogs) => min(4, count($blogs)));
                    @endphp
                    @foreach ($random->all() as $blog)
                    <div class="d-flex mb-3">
                        <img src="{{asset('blog/'.$blog->file)}}" style="width: 100px; height: 100px; object-fit: cover;">
                        <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                            <div class="mb-1" style="font-size: 13px;">
                                <a href="">{{$blog->categorys->name}}</a>
                                <span class="px-1">/</span>
                                <span>{{$blog->postDate}}</span>
                            </div>
                            <a class="h6 m-0" href="">{{$blog->title}}</a>
                        </div>
                    </div>
                    @endforeach

                </div>
                <!-- Popular News End -->
            </div>
        </div>
    </div>
</div>
</div>
<!-- News With Sidebar End -->
@endsection
