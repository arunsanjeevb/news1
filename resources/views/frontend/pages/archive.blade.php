@extends('frontend.master')

@section('main_content')

    <!-- Maan Breadcrumb Start -->
    <nav aria-label="breadcrumb" class="maan-breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL('/') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('E-NEWSPAPER ARCHIVE') }}</li>
            </ol>
        </div>
    </nav>
    <style>
        .business .maan-default-post{
            margin-top:0px !important;
        }
    </style>
    <!-- Maan Breadcrumb End -->
    <!-- Maan Photo Gallery Start -->
    <section class="business maan-slide-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">

                    <div class="maan-news-post">
                        <div class="row"><h3>E-NEWSPAPER ARCHIVE</h3>
                        <span>Select any date from below Date Selector to access the selected e-newspaper</span>
                        </div>
                        <div class="input-group">
                                <div class="col-md-6">
                                    <form class="form-control">
                                        @csrf
                                    <input type="date" class="form-control" style="margin-bottom: 10px;" id="get_date">
                                    <button type="button" id="get_pdf" class="btn-sm btn-primary" >Get E-Newspaper</button>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="maan-news-post">
                        <div class="row"><h3>E-NEWSPAPER DATED : <span id="show_date">26-6-2023</span></h3></div>
                        <div id="show_pdf">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Maan Photo Gallery End -->
    <!-- Maan Pagination Start -->
    <nav class="maan-pagination" aria-label="Page navigation example">
        <div class="container">
            @if(1==2)
            {{ $videogalleries->links() }}
            @endif
        </div>
    </nav>
    <!-- Maan Pagination End -->
@endsection
