<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Paperless Hospital')</title>
    <link rel="icon" type="image/jpg" sizes="16x16" href="{{ asset('public/images/favicon.png') }}">

    <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebars.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="{{ asset('libs\select2\4.1.0\css\select2.min.css' )}}" rel="stylesheet" />
    <link href="{{ asset('fonts/fontawesome-free/font_awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('link')
    <link href="{{ asset('css/my_style.css') }}" rel="stylesheet">
    @stack('custom-style')
</head>

<body>
    <div class="wrapper">
        <input type='hidden' id='base_url'  value="{{ url('/') }}" />
        @include('layouts.sidebar')
        <div class="content-wrapper px-4 pb-5">
            @include('layouts.header')
            @include('layouts.modal')
            <x-alert></x-alert>
            @yield('content')
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('libs\inputmask\3.3.4\js\jquery.inputmask.bundle.min.js' )}}"></script>
    <script src="{{ asset('js/global/global_function.js' )}}"></script>
    <script src="{{ asset('js/main.js' )}}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.js' )}}"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script> -->
    @stack('custom-script')
    <!-- <script src="{{ asset('libs\iconify\2.0.3\iconify.min.js' )}}"></script> -->
    @stack('link-script')

    <!-- Select2 js -->
    <script src="{{ asset('libs\select2\4.1.0\js\select2.min.js' )}}"></script>
</body>

</html>