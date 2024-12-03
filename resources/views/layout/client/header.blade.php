<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.exzoom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/gh/lelinh014756/fui-toast-js@master/assets/css/toast@1.0.1/fuiToast.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

</head>

<body>
    <div id="fui-toast"></div>

    <section class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-sm-6 col-md-8">
                    <ul class="topbar_info d-flex flex-wrap d-none d-sm-flex">
                        <li>
                            <a href="mailto:123123@gmail.com">
                                <i class="fas fa-envelope"></i> 123123@gmail.com
                            </a>
                        </li>
                        <li class="d-none d-md-block">
                            <a href="callto:0369639936"><i class="fas fa-phone-alt"></i>
                                0999 333 666
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-xl-6 col-sm-6 col-md-4">
                    <ul class="topbar_icon d-flex flex-wrap">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a> </li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a> </li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a> </li>
                        <li><a href="#"><i class="fab fa-behance"></i></a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <nav class="navbar navbar-expand-lg main_menu">
        <div class="container">
            <a class="navbar-brand" href="{{ route('client.home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="logo" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="far fa-bars menu_icon_bar"></i>
                <i class="far fa-times close_icon_close"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('client.home') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('client.home') }}">Trang chủ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="#">Thực đơn</a>
                    </li>
                </ul>

                <ul class="menu_icon d-flex flex-wrap">
                    <li>
                        <a class="cart_icon" href="#">
                            <i class="fas fa-shopping-basket"></i>
                        </a>
                    </li>
                    <li>
                        @if (session('customer') || session('admin'))
                            <a href="#"><i class="fas fa-user"></i></a>
                        @else
                            <a href="#"><i class="fas fa-user"></i></a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
