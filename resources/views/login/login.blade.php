<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php
    $settings = settings();
    @endphp
    <meta charset="{{ config('app.charset') }}">
    <meta name="viewport" content="{{ __('width=device-width, initial-scale=1') }}">
    <!-- favicon -->
    <link rel="icon" href="{{ asset($settings->favicon) }}">

    <title>{{ $settings->title }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ asset('public/admin/fonts/google-font-sans.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/admin/dist/css/adminlte.min.css') }}">
    <style>
        .forgetsec a{
            color: black;
            font-size: 13px;
            padding: 4px;
        }
        .forgetpass{
            padding-right: 20px;
        }
    </style>


</head>
<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ URL('/') }}"><img src="{{ asset($settings->logo) }}" alt="img" style="width: 75%;"></a>
        </div>
        <div id="loginMessage">
            @if (session()->has('message'))
                <div class="alert alert-{{session('type')}}">
                    {{session('message')}}
                </div>

            @endif
        </div>

        <div class="card-body">

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password"  name="password" id="password"  class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <button type="submit" class="btn btn-success btn-block">{{ __('LogIn') }}</button>
                </div>
                <!-- /.col -->

                <div class=" btn-group">
                    <a href="#" class="btn btn-primary btn-xs" onclick="copy('superadmin21@gmail.com', 'superadmin21')" data-toggle="tooltip" data-placement="top">
                        <i class="fas fa-lock"></i>
                        {{ __('Super Admin') }}
                    </a>

                    <a href="#"  class="btn btn-info btn-xs" onclick="copy('admin21@gmail.com', 'admin21')" data-toggle="tooltip" data-placement="top">
                        <i class="fas fa-lock"></i>
                        {{ __('Admin') }}
                    </a>

                    <a href="#"  class="btn btn-secondary btn-xs" onclick="copy('editor21@gmail.com', 'editor21')" data-toggle="tooltip" data-placement="top">
                        <i class="fas fa-lock"></i>
                        {{ __('Editor') }}
                    </a>
                    <a href="#"  class="btn btn-primary btn-xs" onclick="copy('reporter21@gmail.com', 'reporter21')" data-toggle="tooltip" data-placement="top">
                        <i class="fas fa-lock"></i>
                        {{ __('Reporter') }}
                    </a>
                    <a href="#"  class="btn btn-info btn-xs" onclick="copy('accountant21@gmail.com', 'accountant21')" data-toggle="tooltip" data-placement="top">
                        <i class="fas fa-lock"></i>
                        {{ __('Accountant') }}
                    </a>

                    <!-- /.col -->
                </div><br>

                <div class="input-group forgetsec" >
                    <a href="#" >
                        <p class="forgetpass"><a href="#"><i class="fa fa-key"></i> {{ __('Forgot Password?') }}</a></p>
                        <p><a href="{{ url('/home') }}" target="_blank"><i class="fa fa-box-open"></i> {{ __('Frontend') }}</a></p>

                        <p><a href="#"><i class="fa fa-user"></i> {{ __('User Login') }}</a></p>

                    </a>

                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/admin/dist/js/adminlte.min.js') }}"></script>
<!-- Login JS -->
<script src="{{ asset('public/admin/js/login.js') }}"></script>

</body>
</html>
