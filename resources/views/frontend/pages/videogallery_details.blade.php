@extends('frontend.master')

@section('main_content')
    <main>
        <!-- Maan Breadcrumb Start -->
        <nav aria-label="breadcrumb" class="maan-breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ URL('/') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Video Gallery Details') }}</li>
                </ol>
            </div>
        </nav>
        <!-- Maan Breadcrumb End -->

        <style>
            section .maan-title-border-none .maan-title-text h2{
                font-size: 2rem !important;
            }
        </style>
        <!-- Maan Archive Details Start -->
        <section class="maan-archive-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="maan-title-border-none">
                            <div class="maan-title-text">
                                <h2>{{ $videogallery->title }}</h2>
                            </div>
                        </div>
                        <div class="card maan-default-post">
                            <div class="maan-post-img">
                                <iframe src="{{ asset($videogallery->video) }}" alt="top-news" width="850" height="380"></iframe>
                            </div>
                            <div class="card-body maan-card-body">
                                <div class="maan-text">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <ul>
                                                <li>
                                                    <span class="maan-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12.007" height="13.414" viewBox="0 0 12.007 13.414">
                                                    <g   transform="translate(-24.165)">
                                                        <g   data-name="Group 466" transform="translate(26.687)">
                                                        <g   data-name="Group 465" transform="translate(0)">
                                                            <path   data-name="Path 845" d="M114.274,0a3.483,3.483,0,1,0,3.483,3.483A3.492,3.492,0,0,0,114.274,0Z" transform="translate(-110.791)" fill="#888"/>
                                                        </g>
                                                        </g>
                                                        <g    data-name="Group 468" transform="translate(24.165 7.215)">
                                                        <g   data-name="Group 467" transform="translate(0)">
                                                            <path   data-name="Path 846" d="M36.147,250.375a3.247,3.247,0,0,0-.35-.639,4.329,4.329,0,0,0-3-1.886.641.641,0,0,0-.441.106,3.712,3.712,0,0,1-4.38,0,.571.571,0,0,0-.441-.106,4.3,4.3,0,0,0-3,1.886,3.743,3.743,0,0,0-.35.639.323.323,0,0,0,.015.289,6.067,6.067,0,0,0,.411.608,5.778,5.778,0,0,0,.7.791,9.112,9.112,0,0,0,.7.608,6.936,6.936,0,0,0,8.274,0,6.685,6.685,0,0,0,.7-.608,7.021,7.021,0,0,0,.7-.791,5.329,5.329,0,0,0,.411-.608A.26.26,0,0,0,36.147,250.375Z" transform="translate(-24.165 -247.841)" fill="#888"/>
                                                        </g>
                                                        </g>
                                                    </g>
                                                    </svg>

                                                    </span>
                                                    <span class="maan-item-text"><a href="#">{{ $videogallery->reporter_name }}</a></span>
                                                </li>
                                                <li>
                                                    <span class="maan-icon"><svg viewBox="0 0 512 512"><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978 c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952 C357.766,320.208,355.981,307.775,347.216,301.211z"></path><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341 S375.275,472.341,256,472.341z"></path></svg></span>
                                                    <span class="maan-item-text">{{ $videogallery->created_at->format('d M, Y') }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="social-media">
                                                <ul>
                                                    <li>
                                                        <a href="https://www.facebook.com/sharer/sharer.php?u= {{url()->current()}}" target="_blank"><img src="{{ asset('public/uploads/images/logo/fb.png') }} " alt="{{ asset('public/uploads/images/logo/fb.png') }}" style="width: 35px !important;"></a>
                                                    </li>
                                                    <li>
                                                        <a href="https://twitter.com/intent/tweet?url= {{url()->current()}}"><img src="{{ asset('public/uploads/images/logo/twitter.png') }} " alt="{{ asset('public/uploads/images/logo/twitter.png') }}" style="width: 35px !important;"></a>
                                                    </li>
                                                    <li>
                                                        <a href="http://www.linkedin.com/shareArticle?mini=true&url={{url()->current()}}" target="_blank"><img src="{{ asset('public/uploads/images/logo/ln.png') }} " alt="{{ asset('public/uploads/images/logo/ln.png') }}" style="width: 35px !important;"> </a>
                                                    </li>

                                                    <li>
                                                        <a href="http://www.instagram.com/shareArticle?mini=true&url={{url()->current()}}" target="_blank"><img src="{{ asset('public/uploads/images/logo/insta.png') }} " alt="{{ asset('public/uploads/images/logo/insta.png') }}" style="width: 35px !important;"> </a>
                                                    </li>

                                                    <li>
                                                        <a href="http://www.whatsapp.com/shareArticle?mini=true&url={{url()->current()}}" target="_blank"><img src="{{ asset('public/uploads/images/logo/whatsapp.png') }} " alt="{{ asset('public/uploads/images/logo/whatsapp.png') }}" style="width: 35px !important;"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <p>{{ $videogallery->description }}  </p>
                                </div>
                            </div>
                        </div>
                        @if(1==2)
                        <div class="maan-post-adds">
                            <a href=" @if (advertisement()) {{advertisement()->leaderboard_url}} @else https://www.google.com/ @endif " target="_blank">
                                <img src="
@if (advertisement()) {{asset(advertisement()->leaderboard_image)}} @else {{ asset('public/frontend/img/post-add/add.jpg') }} @endif " alt="{{ asset('public/frontend/img/post-add/add.jpg') }}">
                            </a>
                        </div> @endif

                    </div>
                    <div class="col-lg-4">
                    <div class="maan-title">
                            <div class="maan-title-text">
                                <h2>{{ __('Gallery') }}</h2>
                            </div>
                        </div>
                        <div class="maan-widgets">
                            <div class="widgets-gallery">
                                <ul>
                                    @php
                                    $photogalleries = photogalleries();
                                    @endphp
                                    @foreach($photogalleries as $videogallery)
                                    <li>
                                        <a href="{{ route('videogallery.details',$videogallery->id) }}">
                                            <iframe src="{{ asset($videogallery->video) }}" alt="top-news"></iframe>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    @if(1==2)
                        <div class="maan-title">
                            <div class="maan-title-text">
                                <h2>{{ __('Search') }}</h2>
                            </div>
                        </div>
                        <div class="maan-widgets">
                            <form class="search">
                                <div class="input-group">
                                    <input type="search" class="form-control" placeholder="Search ...">
                                    <button type="submit" class="d-btn"><svg viewBox="0 0 511.999 511.999"><path d="M508.874,478.708L360.142,329.976c28.21-34.827,45.191-79.103,45.191-127.309c0-111.75-90.917-202.667-202.667-202.667 S0,90.917,0,202.667s90.917,202.667,202.667,202.667c48.206,0,92.482-16.982,127.309-45.191l148.732,148.732 c4.167,4.165,10.919,4.165,15.086,0l15.081-15.082C513.04,489.627,513.04,482.873,508.874,478.708z M202.667,362.667 c-88.229,0-160-71.771-160-160s71.771-160,160-160s160,71.771,160,160S290.896,362.667,202.667,362.667z"></path></svg></button>
                                </div>
                            </form>
                        </div>
                        @endif
                        @if(1==2)
                        <div class="maan-title">
                            <div class="maan-title-text">
                                <h2>{{ __('Category') }}</h2>
                            </div>
                        </div>
                        <div class="maan-widgets">
                            <div class="category-link">
                                <ul>

                                    @foreach(newscategories() as $newscategory)
                                    <li><a href="
                                    @if(Route::has(strtolower($newscategory->slug)))
{{ route(strtolower($newscategory->slug),strtolower($newscategory->name)) }}
                                            @endif
                                            ">
                                            {{ $newscategory->name }}
                                        </a></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        @endif
                        @if(1==2)
                        <div class="maan-title">
                            <div class="maan-title-text">
                                <h2>{{ __('Gallery') }}</h2>
                            </div>
                        </div>
                        <div class="maan-widgets">
                            <div class="widgets-gallery">
                                <ul>
                                    @php
                                    $photogalleries = photogalleries();
                                    @endphp
                                    @foreach($photogalleries as $videogallery)
                                    <li>
                                        <a href="{{ route('videogallery.details',$videogallery->id) }}"><img src="{{ asset($videogallery->image) }}" alt="gallery"></a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="maan-title">
                            <div class="maan-title-text">
                                <h2>{{ __('Tags') }}</h2>
                            </div>
                        </div>
                        <div class="maan-widgets">
                            <div class="widgets-tags">
                                <ul>
                                    @foreach(newscategories() as $newscategory)
                                        <li><a href="@if(Route::has(strtolower($newscategory->slug))){{ route(strtolower($newscategory->slug),strtolower($newscategory->name)) }}@endif">{{$newscategory->name }}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>

                        <div class="maan-title">
                            <div class="maan-title-text">
                                <h2>{{ __('Social Media') }}</h2>
                            </div>
                        </div>
                        <div class="maan-widgets">
                            <div class="social-media">
                                <ul>
                                    @foreach($socials as $social)
                                        <li><a href="{{$social->url}}" target="_blank"><i class="{{$social->icon_code}}"></i></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </section>
        <!-- Maan Archive Details End -->
        <!-- Maan Related Posts Start -->
        <br>
        <br>
        <section class="maan-related-posts" style="display: none;">
            <div class="container">
                <div class="maan-title">
                    <div class="maan-title-text">
                        <h2>{{ __('Related Stories') }}</h2>
                    </div>
                </div>
                <div class="row maan-post-groop">
                    @foreach($relatedvideogallery as $relatedvideogallery)
                        <div class="col-lg-4">
                            <div class="card maan-default-post">
                                <div class="maan-post-img">
                                    <a href="{{ route('videogallery.details',$relatedvideogallery->id) }}">
                                        <img src="{{ asset($relatedvideogallery->image) }}" alt="top-news">
                                    </a>

                                </div>
                                <div class="card-body maan-card-body">
                                    <div class="maan-text">
                                        <h4><a href="{{ route('videogallery.details',$relatedvideogallery->id) }}">{{ $relatedvideogallery->title }}</a></h4>
                                        <ul>
                                            <!-- <li>
                                                <span class="maan-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12.007" height="13.414" viewBox="0 0 12.007 13.414">
                                                    <g   transform="translate(-24.165)">
                                                        <g   data-name="Group 466" transform="translate(26.687)">
                                                        <g   data-name="Group 465" transform="translate(0)">
                                                            <path   data-name="Path 845" d="M114.274,0a3.483,3.483,0,1,0,3.483,3.483A3.492,3.492,0,0,0,114.274,0Z" transform="translate(-110.791)" fill="#888"/>
                                                        </g>
                                                        </g>
                                                        <g    data-name="Group 468" transform="translate(24.165 7.215)">
                                                        <g   data-name="Group 467" transform="translate(0)">
                                                            <path   data-name="Path 846" d="M36.147,250.375a3.247,3.247,0,0,0-.35-.639,4.329,4.329,0,0,0-3-1.886.641.641,0,0,0-.441.106,3.712,3.712,0,0,1-4.38,0,.571.571,0,0,0-.441-.106,4.3,4.3,0,0,0-3,1.886,3.743,3.743,0,0,0-.35.639.323.323,0,0,0,.015.289,6.067,6.067,0,0,0,.411.608,5.778,5.778,0,0,0,.7.791,9.112,9.112,0,0,0,.7.608,6.936,6.936,0,0,0,8.274,0,6.685,6.685,0,0,0,.7-.608,7.021,7.021,0,0,0,.7-.791,5.329,5.329,0,0,0,.411-.608A.26.26,0,0,0,36.147,250.375Z" transform="translate(-24.165 -247.841)" fill="#888"/>
                                                        </g>
                                                        </g>
                                                    </g>
                                                    </svg>

                                                </span>
                                                <span class="maan-item-text"><a href="#">{{ $relatedvideogallery->reporter_name }}</a></span>
                                            </li> -->
                                            <!-- <li>
                                                <span class="maan-icon"><svg viewBox="0 0 512 512"><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978 c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952 C357.766,320.208,355.981,307.775,347.216,301.211z"></path><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341 S375.275,472.341,256,472.341z"></path></svg></span>
                                                <span class="maan-item-text">{{ $relatedvideogallery->created_at->format('d M, Y') }}</span>
                                            </li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- Maan Related Posts End -->
    </main>

@endsection
