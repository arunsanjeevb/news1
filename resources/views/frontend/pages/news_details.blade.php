@extends('frontend.master')
@section('meta_content')
    @php
        $imagemeta = json_decode($getnews->image);
    @endphp
    <meta name="keywords" content="{{ $getnews->meta_keyword }}">
    <meta name="title" content="{{ $getnews->title }}">
    <meta name="description" content="{{ $getnews->meta_description }}">
    <meta name="author" content="{{ $getnews->reporter_name }}">

    <meta property="og:keywords" content="{{ $getnews->meta_keyword }}">
    <meta property="og:title" content="{{ $getnews->title }}">
    <meta property="og:description" content="{{ $getnews->meta_description }}">
    <meta property="og:author" content="{{ $getnews->reporter_name }}">
    <meta property="og:image" content="{{ asset($imagemeta[0]) }}" />

@endsection

@section('main_content')
<style>
    section .maan-title-border-none .maan-title-text h2{
        font-size: 2.75rem !important;
        line-height: 1.5 !important;
    }

     @media (max-width: 600px){
        section .maan-title-border-none .maan-title-text h2{
            font-size: 17px !important;
            line-height: 1.5 !important;
        }
    }
</style>

    <main>
        <!-- Maan Breadcrumb Start -->
        <?php $url = $_SERVER['REQUEST_URI'];  ?>
        <nav aria-label="breadcrumb" class="maan-breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ URL('/') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $getnews->news_category }}</li>
                </ol>
            </div>
        </nav>
        <!-- Maan Breadcrumb End -->
        <!-- Maan Archive Details Start -->
        <section class="maan-archive-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="maan-title-border-none">
                            <div class="maan-title-text">
                                <h2>{{ $getnews->title }} </h2>
                                @if(stripos($url,'columns-news'))
                                <p>{{ $getnews->summary }}</p>
                                @endif
                            </div>
                        </div>
                        @if(stripos($url,'columns-news'))
                        <div class="row">
                            <div class="col-md-1">
                                <img src="{{ asset($getnews->reporter_pic) }}" alt="top-news">
                            </div>
                            <div class="col-md-3">
                                <span>{{ $getnews->reporter_name }}</span>
                            </div>
                        </div><br>
                        @endif
                        <div class="card maan-default-post">
                            <div class="maan-post-img">
                                @if ($getnews->image)
                                    @php
                                        $images = json_decode($getnews->image);
                                    @endphp
                                    @if($images!='')
                                        @foreach ($images as $image)
                                            @if (File::exists($image))

                                                <img src="{{ asset($image) }}" alt="top-news">
                                            @endif
                                        @endforeach
                                    @endif

                                @endif
                            </div>
                            <div class="card-body maan-card-body">
                                <div class="maan-text">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li> <p>{{ $getnews->summary }}</p>  </li>
                                                <li>
                                                    <span class="maan-icon" style="display: none">
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
                                                    <span class="maan-item-text" style="display: none"><a href="#">{{ $getnews->reporter_name }}</a></span>
                                                </li>
                                                <li>
{{--                                                    <span class="maan-icon"><svg viewBox="0 0 512 512"><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978 c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952 C357.766,320.208,355.981,307.775,347.216,301.211z"></path><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341 S375.275,472.341,256,472.341z"></path></svg></span>--}}
{{--                                                    <span class="maan-item-text">{{ (new \Illuminate\Support\Carbon($getnews->date))->format('d M, Y') }}</span>--}}
                                                </li>
                                            </ul>
                                        </div>
                                        @if(1==2)
                                        <div class="maan-post-adds">
                                            @if (advertisement())
                                                {!! advertisement()->before_post_ads !!}
                                            @else
                                                <a href="https://www.google.com/" target="_blank">
                                                    <img src="{{ asset('public/frontend/img/post-add/add.jpg') }}" alt="{{ asset('public/frontend/img/post-add/add.jpg') }}">
                                                </a>
                                            @endif


                                        </div>
                                        @endif
                                    </div>
                                    <p>{!! $getnews->description !!} </p>
                                </div>
                            </div>
                        </div>

                        @if(1==2)
                            <div class="maan-post-adds" >
                                @if (advertisement())
                                    {!! advertisement()->after_post_ads !!}
                                @else
                                    <a href="https://www.google.com/" target="_blank">
                                        <img src="{{ asset('public/frontend/img/post-add/add.jpg') }}" alt="{{ asset('public/frontend/img/post-add/add.jpg') }}">
                                    </a>
                                @endif


                            </div>
                        @endif

                        <div class="social-media blog-details-social">
                            <h6>Share Now</h6>
                            <ul>
                                <li>

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
                        @if($getnews->hide_commends)
                        <div class="maan-news-form">
                            <h4>{{ __('Leave a Reply') }}</h4>
                            <p>{{ __('Your email address will not be published. Required fields are marked *') }}</p>
                            <form class="row" action="{{route('news.comment',$getnews->id)}}" method="POST">
                                @csrf
                                <div class="col-lg-6">
                                    <input type="text" name="name" placeholder="Your Name">
                                    @error('name')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" name="email" placeholder="Your Email">
                                    @error('email')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <textarea name="comment" placeholder="Write Comments"></textarea>
                                    @error('comment')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit">{{ __('Post Comment') }}</button>
                                </div>
                            </form>
                            <div>

                                @foreach($newscomments as $newscomment)
                                    <div class="custom-group row">
                                        <div class=" col-md-1 col-2">
                                            <span class="icon"><svg viewBox="0 0 512 512"><path d="M333.187,237.405c32.761-23.893,54.095-62.561,54.095-106.123C387.282,58.893,328.389,0,256,0 S124.718,58.893,124.718,131.282c0,43.562,21.333,82.23,54.095,106.123C97.373,268.57,39.385,347.531,39.385,439.795 c0,39.814,32.391,72.205,72.205,72.205H400.41c39.814,0,72.205-32.391,72.205-72.205 C472.615,347.531,414.627,268.57,333.187,237.405z M164.103,131.282c0-50.672,41.225-91.897,91.897-91.897 s91.897,41.225,91.897,91.897S306.672,223.18,256,223.18S164.103,181.954,164.103,131.282z M400.41,472.615H111.59 c-18.097,0-32.82-14.723-32.82-32.821c0-97.726,79.504-177.231,177.231-177.231s177.231,79.504,177.231,177.231 C433.231,457.892,418.508,472.615,400.41,472.615z"></path></svg></span>
                                        </div>
                                        <div class="col-md-10">
                                            <h4>{{ $newscomment->name }}</h4>
                                            <p>{{ $newscomment->comment }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="container">
                                {{ $newscomments->links() }}
                            </div>

                        </div>
                        @endif
                    </div>

                    <div class="col-lg-4">
                        <div class="maan-title">
                            <div class="maan-title-text">
                                <h2>{{ __('Related Post') }}</h2>
                            </div>
                        </div>
                        <div class="maan-widgets maan-bg-tr">
                            <div class="popular-post">
                                @foreach($relatedgetsnews as $popularnews)
                                    <div class="card maan-default-post">
                                        <div class="maan-card-img">
                                            @if ($popularnews->image)
                                                @php
                                                    $images = json_decode($popularnews->image);
                                                @endphp
                                                @if($images!='')
                                                    @foreach ($images as $image)
                                                        @if (File::exists($image))
                                                            <a href="{{ route($popularnews->news_categoryslug.'.details',['id'=>$popularnews->id,'slug'=>\Illuminate\Support\Str::slug($popularnews->title)]) }}">
                                                                <img src="{{ asset($image) }}" alt="top-news">
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                @endif

                                            @endif
                                        </div>
                                        <div class="card-body maan-card-body">
                                            <div class="maan-text">
                                                <h4><a href="{{ route($popularnews->news_categoryslug.'.details',['id'=>$popularnews->id,'slug'=>\Illuminate\Support\Str::slug($popularnews->title)]) }}">{{ $popularnews->title }}</a></h4>
                                                <ul>
                                                    <!-- <li>
                                                    <span class="maan-icon"><svg viewBox="0 0 512 512"><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978 c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952 C357.766,320.208,355.981,307.775,347.216,301.211z"></path><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341 S375.275,472.341,256,472.341z"></path></svg></span>
                                                    <span class="maan-item-text">{{ (new \Illuminate\Support\Carbon($popularnews->date))->format('d M, Y') }}</span>
                                                </li> -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        @if(1==2)
                            <div class="maan-title">
                                <div class="maan-title-text">
                                    <h2>{{ __('Tags') }}</h2>
                                </div>
                            </div>
                            <div class="maan-widgets">
                                <div class="widgets-tags">
                                    <ul>
                                        @foreach(newscategories() as $newscategory)
                                            <li><a href="{{route($newscategory->slug,strtolower($newscategory->name))}}">{{ $newscategory->name }}</a></li>
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
        @if(1==2)
        <section class="maan-related-posts">
            <div class="container">
                <div class="maan-title">
                    <div class="maan-title-text">
                        <h2>{{ __('Related Posts') }}</h2>
                    </div>
                </div>
                <div class="row maan-post-groop">
                    @foreach($relatedgetsnews as $relatednews)
                    <div class="col-lg-4">
                        <div class="card maan-default-post">
                            <div class="maan-post-img">
                                @if ($relatednews->image)
                                    @php
                                        $images = json_decode($relatednews->image);
                                    @endphp
                                    @if($images!='')
                                        @foreach ($images as $image)
                                            @if (File::exists($image))
                                                <a href="{{ route($relatednews->news_categoryslug.'.details',['id'=>$relatednews->id,'slug'=>\Illuminate\Support\Str::slug($relatednews->title)]) }}">
                                                    <img src="{{ asset($image) }}" alt="top-news">
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif

                                @endif

                            </div>
                            <div class="card-body maan-card-body">
                                <div class="maan-text">
                                    <h4><a href="{{ route($relatednews->news_categoryslug.'.details',['id'=>$relatednews->id,'slug'=>\Illuminate\Support\Str::slug($relatednews->title)]) }}">{{ $relatednews->title }}</a></h4>
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
                                            <span class="maan-item-text"><a href="#">{{ $relatednews->reporter_name }}</a></span>
                                        </li> -->
                                        <!-- <li>
                                            <span class="maan-icon"><svg viewBox="0 0 512 512"><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978 c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952 C357.766,320.208,355.981,307.775,347.216,301.211z"></path><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341 S375.275,472.341,256,472.341z"></path></svg></span>
                                            <span class="maan-item-text">{{ (new \Illuminate\Support\Carbon($relatednews->date))->format('d M, Y') }}</span>
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
        @endif
    </main>

@endsection
