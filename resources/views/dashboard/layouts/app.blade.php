<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POS . @yield('title')</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" href="{{asset('image/AdminLTELogo.png')}}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Multi Select Drop Down 2-->
    <link rel="stylesheet" href="{{asset('css/plugins/select2/select2.min.css')}}">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/2818147cbc.js" crossorigin="anonymous"></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script> --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwh-0lz7wqabX30o5b9ro9nv_JIPWuJOM&libraries=places&callback=initialize"></script>
    
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
    <!-- Toastr-->
    <link rel="stylesheet" href="{{asset('css/plugins/toastr/toastr.min.css')}}">
    <!-- fontawesome-free-->

    @yield('css')

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('dashboard.partials.navbar')

    @include('dashboard.partials.sidebar')

    @yield('content')

    @include('dashboard.partials.control-sidebar')

    @include('dashboard.partials.footer')

</div>
<!-- ./wrapper -->
@yield('modal')
<script src="{{asset('js/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/plugins/bootstrap/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/dashboard/demo.js')}}"></script>
<script src="{{asset('js/dashboard/adminlte.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('js/plugins/toastr/toastr.min.js')}}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@yield('js')


</body>
</html>
