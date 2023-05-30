@extends('frontend.master')
@section('meta_content')
    <meta name="keywords" content="{{ seooptimization()->keywords }}">
    <meta name="title" content="{{ seooptimization()->meta_title }}">
    <meta name="description" content="{{ seooptimization()->meta_description }}">
    <meta name="author" content="{{ seooptimization()->author }}">

    <meta property="og:keywords" content="{{ seooptimization()->keywords }}">
    <meta property="og:title" content="{{ seooptimization()->meta_title }}">
    <meta property="og:description" content="{{ seooptimization()->meta_description }}">
    <meta property="og:author" content="{{ seooptimization()->author }}">
    <meta property="og:image" content="{{ asset(settings()->logo) }}" />

@endsection
@section('main_content')


<style>

.clm-warp p {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

</style>
    <!-- Maan Breadcrumb Start -->
    <nav aria-label="breadcrumb" class="maan-breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL('/') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ 'Live News' }}</li>
            </ol>
        </div>
    </nav>
    <!-- Maan Breadcrumb End -->
    <!-- Maan Business Start -->
    <section class="business maan-slide-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="maan-title">
                        <div class="maan-title-text">
                            <h2>{{ 'Columns' }}</h2>
                        </div>
                    </div>
                    <div class="maan-news-post">
                        @foreach($allnews as $allnewsall )
                            @if($loop->first)
                            <div class="card maan-default-post">
                                <div class="maan-post-img">
                                    @if ($allnewsall->image)
                                        @php
                                            $images = json_decode($allnewsall->image);
                                        @endphp
                                        @if($images!='')
                                            @foreach ($images as $image)
                                                @if (File::exists($image))
                                                    <a href="{{ route(strtolower($allnewsall->news_categoryslug).'.details',['id'=>$allnewsall->id,'slug'=>\Illuminate\Support\Str::slug($allnewsall->title)]) }}">
                                                        <img src="{{ asset($image) }}" alt="top-news">
                                                    </a>
                                                @endif
                                            @endforeach
                                        @endif

                                    @endif

                                </div>
                                <div class="card-body maan-card-body">
                                    <div class="maan-text">
                                        <h2><a href="{{ route(strtolower($allnewsall->news_categoryslug).'.details',['id'=>$allnewsall->id,'slug'=>\Illuminate\Support\Str::slug($allnewsall->title)]) }}">{{ $allnewsall->title }}</a></h2>
                                        <p class="mt-0">{{ $allnewsall->summary }}</p>
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
                                                <span class="maan-item-text"><a href="#">{{ $allnewsall->reporter_name }}</a></span>
                                            </li>
                                            <li>
                                                <span class="maan-icon"><svg viewBox="0 0 512 512"><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978 c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952 C357.766,320.208,355.981,307.775,347.216,301.211z"></path><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341 S375.275,472.341,256,472.341z"></path></svg></span>
                                                <span class="maan-item-text">{{ (new \Illuminate\Support\Carbon($allnewsall->date))->format('d M, Y') }}</span>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                            <div class="row col-md-12 news-details-colm">

                                @foreach($allnews as $allnewsall )
                                    <div class="card maan-default-post col-md-4 ">
                                        <div class="maan-post-img">
                                            @if ($allnewsall->image)
                                                @php
                                                    $images = json_decode($allnewsall->image);
                                                @endphp
                                                @if($images!='')
                                                    @foreach ($images as $image)
                                                        @if (File::exists($image))
                                                            <a href="{{ route(strtolower($allnewsall->news_categoryslug).'.details',['id'=>$allnewsall->id,'slug'=>\Illuminate\Support\Str::slug($allnewsall->title)]) }}">
                                                                <img src="{{ asset($image) }}" alt="top-news">
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                @endif

                                            @endif

                                        </div>
                                        <div class="card-body maan-card-body">
                                            <div class="maan-text">
                                                <h2><a href="{{ route(strtolower($allnewsall->news_categoryslug).'.details',['id'=>$allnewsall->id,'slug'=>\Illuminate\Support\Str::slug($allnewsall->title)]) }}" style="display: -webkit-box;
-webkit-line-clamp: 3;
-webkit-box-orient: vertical;
overflow: hidden;
text-overflow: ellipsis;">{{ $allnewsall->title }}</a></h2>
{{--                                                <p class="mt-0">{{ $allnewsall->summary }}</p>--}}
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
                                                    <span class="maan-item-text"><a href="#">{{ $allnewsall->reporter_name }}</a></span>
                                                </li> -->
                                                    <!-- <li>
                                                    <span class="maan-icon"><svg viewBox="0 0 512 512"><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978 c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952 C357.766,320.208,355.981,307.775,347.216,301.211z"></path><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341 S375.275,472.341,256,472.341z"></path></svg></span>
                                                    <span class="maan-item-text">{{ (new \Illuminate\Support\Carbon($allnewsall->date))->format('d M, Y') }}</span>
                                                </li> -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="maan-title">
                        <div class="maan-title-text">
                            <h2>{{ __('Related Stories') }}</h2>
                        </div>
                    </div>

                    <div class="maan-widgets maan-bg-tr">
                        <div class="maan-news-list recent-post">
                            <ul>
                                @foreach($recentallnews as $recentallnews)
                                    <li>
                                        <div class="maan-list-img">
                                        @if ($recentallnews->image)
                                                @php
                                                    $images = json_decode($recentallnews->image);
                                                @endphp
                                                @if($images!='')
                                                    @foreach ($images as $image)
                                                        @if (File::exists($image))
                                                            <a href="{{ route($recentallnews->news_categoryslug.'.details',['id'=>$recentallnews->id,'slug'=>\Illuminate\Support\Str::slug($recentallnews->title)]) }}">
                                                                <img src="{{ asset($image) }}" alt="list-news-img">
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                @endif

                                            @endif

                                        </div>
                                        <div class="maan-list-text clm-warp">
                                            <h4><a href="{{ route($recentallnews->news_categoryslug.'.details',['id'=>$recentallnews->id,'slug'=>\Illuminate\Support\Str::slug($recentallnews->title)]) }}">{{ $recentallnews->title }}</a></h4>
                                            <p class="mt-0">{{ $recentallnews->summary }}</p>
                                            <!-- <ul>
                                                <li>
                                                    <span class="maan-icon"><svg viewBox="0 0 512 512"><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978 c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952 C357.766,320.208,355.981,307.775,347.216,301.211z"></path><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341 S375.275,472.341,256,472.341z"></path></svg></span>
                                                    <span class="maan-item-text">{{ (new \Illuminate\Support\Carbon($recentallnews->date))->format('d M, Y') }}</span>
                                                </li>
                                            </ul> -->
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>

                    <!-- ss -->
                    
                  
                </div>
            </div>
        </div>
    </section>
    <!-- Maan Business End -->
    <!-- Maan Pagination Start -->
    <nav class="maan-pagination" aria-label="Page navigation example">
        <div class="container">
            {{ $allnews->links() }}
        </div>
    </nav>
    <!-- Maan Pagination End -->
@endsection
