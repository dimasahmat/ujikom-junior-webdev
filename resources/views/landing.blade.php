<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" type="image/png">
    <title>Staff Hub</title>

    {{-- bootstrap css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/linericon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/nice-select/css/nice-select.css') }}">

    {{-- main css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    {{-- header start --}}
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    {{-- brand icon --}}
                    <a class="navbar-brand logo_h" href="#welcome"><img src="{{ asset('assets/img/logo.png') }}"
                            alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    {{-- navbar menu --}}
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav justify-content-end">
                            <li class="nav-item active"><a class="nav-link" href="#welcome">Beranda</a></li>
                            <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
                            <li class="nav-item"><a class="nav-link" href="https://github.com/dimasahmat">Kontak</a>
                            </li>
                            @if (Auth::check())
                                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Daftar</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Masuk</a></li>
                            @else
                                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Daftar</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Masuk</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    {{-- navbar end --}}

    {{-- home banner start --}}
    <section class="home_banner_area" id="welcome">
        <div class="banner_inner">
            <div class="container">
                <div class="row" id="welcome">
                    <div class="col-lg-7">
                        <div class="banner_content">
                            <h3 class="text-uppercase">Selamat datang di</h3>
                            <h1 class="text-uppercase">Staff Hub</h1>
                            <div class="d-flex align-items-center">
                                @if (Auth::check())
                                    <a class="primary_btn" href="{{ route('login') }}"><span>Masuk</span></a>
                                    <a class="primary_btn tr-bg" href="{{ route('register') }}"><span>Daftar</span></a>
                                @else
                                    <a class="primary_btn" href="{{ route('login') }}"><span>Masuk</span></a>
                                    <a class="primary_btn tr-bg" href="{{ route('register') }}"><span>Daftar</span></a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="home_right_img">
                            <img class="" src="{{ asset('assets/img/banner/home-right.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- home banner end --}}

    {{-- about us start --}}
    <section class="about_area section_gap" id="about">
        <div class="container">
            <div class="row justify-content-start align-items-center">
                <div class="col-lg-5">
                    <div class="about_img">
                        <img class="" src="{{ asset('assets/img/about-us.png') }}" alt="">
                    </div>
                </div>

                <div class="offset-lg-1 col-lg-5">
                    <div class="main_title text-left">
                        <h2>Tentang Kami</h2>
                        <p>
                            StaffHub adalah inovasi terbaru dari tim IT,
                            didedikasikan untuk menyediakan solusi modern dalam manajemen data pegawai. Kami berfokus
                            pada kemudahan penggunaan dan inovasi berkelanjutan untuk
                            membantu perusahaan dalam meningkatkan efisiensi dan produktivitas.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- about us end --}}

    {{-- footer start --}}
    <footer class="footer_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="footer_top flex-column">
                        <div class="footer_logo">
                            <a href="#">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                            </a>
                            <h4>Ikuti Kami</h4>
                        </div>
                        <div class="footer_social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                            <a href="#"><i class="fa fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row footer_bottom justify-content-center">
                <p class="col-lg-8 col-sm-12 footer-text">
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> | <a href="https://dimasahmat.web.id" target="_blank">dimasahmat</a>
                </p>
            </div>
        </div>
    </footer>
    {{-- footer end --}}

    {{-- javascript --}}
    <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/stellar.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/isotope/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/isotope/isotope-min.js') }}"></script>
    <script src="{{ asset('assets/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('assets/js/mail-script.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
</body>

</html>
