<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="{{ config('app.charset') }}">
    <meta name="viewport" content="{{ __('width=device-width, initial-scale=1') }}">
    <!-- favicon -->
    <link rel="icon" href="{{ asset(config('app.icon')) }}">
    <meta name="csrf-token">
    <title>{{ __('MAAN|LMS') }}</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ asset('public/admin/fonts/google-font-sans-pro.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons 2.0.1 -->
    <link rel="stylesheet" href="{{ asset('public/admin/fonts/docs/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/maan-custom.css') }}">

    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('public/admin/plugins/summernote/summernote-bs4.min.css') }}">

    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('public/admin/plugins/daterangepicker/daterangepicker.css') }}">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset(config('app.icon')) }}" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    @include('maanuser.partials.header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('maanuser.partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <!-- CSS. Contains page content -->
    @yield('css_content')
    <!-- Main. Contains page content -->
    @yield('main_content')
    <!-- JS. Contains page content -->
    @yield('js_content')

    <!-- /.content-wrapper -->
    @include('maanuser.partials.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('public/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<script src="{{ asset('public/admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('public/admin/js/custom-ajax.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/admin/js/maan-custom.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('public/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('public/admin/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/admin/dist/js/demo.js') }}"></script>

<script>
    $(function () {
        $('#summernote').summernote();
    })
</script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });

        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

    })
</script>
<script type="text/javascript">

    var message = "{{session('message')}}";
    if (message!='') {

        if (message=='Inserted'){
            onSubmitInsert()
        }else if( message=='Updated'){
            onSubmitUpdate()
        }else if( message=='Generated'){
            onSubmitGenerate()

        }
    }
    function onSubmitGenerate(){
        Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'Data Generated successfully!',
            showConfirmButton: false,
            timer: 1500,
            onOpen: function() {
                var maanlms = document.getElementById("myAudio");
                maanlms.play();
            }
        })
    }

</script>


</body>
</html>
