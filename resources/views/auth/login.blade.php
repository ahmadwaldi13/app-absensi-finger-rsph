<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Paperless Hospital')</title>
    <link rel="icon" type="image/jpg" sizes="16x16" href="{{ asset('public/images/favicon.png') }}">

    <!-- Styles Bootstrap -->
    <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sidebars.css') }}" rel="stylesheet" />

    <!-- Custumize -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .form-signin {
            width: 100%;
            max-width: 550px;
            padding: 15px;
            margin: auto;
        }
    </style>

</head>

<body>

    <div>
        <div class="py-4 mb-5 bg-dark text-white d-flex flex-row justify-content-center align-items-center">
            <span class="iconify m-0 p-0 me-3" style="font-size: 42px;" data-icon="la:hospital"></span>
            <span style="font-size: 26px;"><?= env('NAME_APP', 'RSUD'); ?></span>
        </div>

        <div class="container-fluid">
            <div class="form-signin">
                <form class="needs-validation mt-5" method="POST" action="{{ url('process-login') }}">
                    @csrf
                    @if(Session::get('login_error_message'))
                    <div class="row">
                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </symbol>
                        </svg>
                        <div class="col-md-12">
                            <div class="alert alert-danger py-2" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                                    <use xlink:href="#exclamation-triangle-fill" />
                                </svg>
                                {{ Session::pull('login_error_message') }}
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="Username" class="form-label">ID User</label>
                        <input type="text" class="form-control" id="username" name="id_user" placeholder="Masukkan Username" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Area ini wajib diisi
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                        <div class="invalid-feedback">
                            Area ini wajib diisi
                        </div>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary" type="submit">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.js' )}}"></script>
    <!-- <script src="{{ asset('libs/popper/2.9.3/popper.min.js' )}}" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script> -->
    <script src="{{ asset('libs/bootstrap/5.1.1/bootstrap.min.js' )}}" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <!-- <script src="{{ asset('libs/iconify/2.0.3/iconify.min.js' )}}"></script> -->
</body>
</html>