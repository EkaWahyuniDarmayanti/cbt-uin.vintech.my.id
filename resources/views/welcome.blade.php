<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>Mentoring Character Building Training</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('landing/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/assets/css/templatemo-digimedia-v3.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/assets/css/owl.css') }}">
    <!--

TemplateMo 568 DigiMedia

https://templatemo.com/tm-568-digimedia

-->
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{ url('/') }}" class="logo">
                            <img src="{{ asset('assets/media/logo.png') }}" style="width: 50px" alt="">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><div class="border-first-button"><a href="{{ route('login') }}">Login</a></div></li> 
                        </ul>        
                        {{-- <a class='menu-trigger'>
                            <span>Menu</span>
                        </a> --}}
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s"
                                data-wow-delay="1s">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h6>Mentoring kegiatan Character Building Training</h6>
                                        <p>mentoring CBT UIN Alaudddin makassar merupakan fase lanjutan setelah mahasiswa mengikuti kegiatan fase pertama yaitu pemberian materi. oleh karena itu, mahasiswa diwajibkan melakukan mentoring pada mentor masing-masing untuk menyelesaikan proses kegiatan CBT UIN Alauddin Makassar.</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="border-first-button scroll-to-section">
                                            <a href="{{ route('login') }}">Mulai Mentoring</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                                <img src="{{ asset('landing/assets/images/slider-dec-v3.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('landing/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('landing/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('landing/assets/js/animation.js') }}"></script>
    <script src="{{ asset('landing/assets/js/imagesloaded.js') }}"></script>
    <script src="{{ asset('landing/assets/js/custom.js') }}"></script>

</body>

</html>
