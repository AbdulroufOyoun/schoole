<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@lang('index.trkolej')</title>
    <!-- Stylesheets -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;600;700;800;900&family=Teko:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- reey font -->
    <link rel="stylesheet" href="website/css/reey-font.css">
    <link href="website/css/bootstrap.min.css" rel="stylesheet">
    <link href="website/css/fontawesome-all.css" rel="stylesheet">
    <link href="website/css/owl.css" rel="stylesheet">
    <link href="website/css/flaticon.css" rel="stylesheet">
    <link href="website/css/animate.css" rel="stylesheet">
    <link href="website/css/jquery-ui.css" rel="stylesheet">
    <link href="website/css/jquery.fancybox.min.css" rel="stylesheet">
    <link href="website/css/hover.css" rel="stylesheet">
    <link rel="stylesheet" href="website/css/jarallax.css">
    <link rel="stylesheet" href="website/css/swiper.min.css">
    <link href="website/css/custom-animate.css" rel="stylesheet">
    <link href="website/css/style.css" rel="stylesheet">
    <link href="website/css/advertising.css" rel="stylesheet">
    <!-- rtl css -->
    <link href="website/css/rtl.css" rel="stylesheet">
    <!-- Responsive File -->
    <link href="website/css/responsive.css" rel="stylesheet">

    <!-- variable update -->
    <link rel="stylesheet" href="website/css/variables/index-6.css">

    <!-- Color css -->
    <link rel="stylesheet" id="jssDefault" href="website/css/colors/color-10.css">

    <link rel="shortcut icon" href="admin_panel/assets/images/full_logo.png" id="fav-shortcut" type="image/x-icon">
    <link rel="icon" href="admin_panel/assets/images/full_logo.png" id="fav-icon" type="image/x-icon">

    <!-- Responsive Settings -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]>
    <script src="website/js/respond.js"></script><![endif]-->
</head>

<body>

<div class="page-wrapper">


    <!-- Preloader -->
    <div class="preloader">
        <div class="icon" style="background-image: url(website/images/icons/preloader.svg);"></div>
    </div>

    <header class="header-six">
        <div class="auto-container">
            <div class="header-six__logo">
                <a href="{{route('home')}}">
                    <img src="admin_panel/assets/images/full_logo.png" class="header_logo" width="70" height="70"
                         alt="logo">
                </a>
                <h5 class="logo_name"> @lang('index.trkolej') </h5>

                <div class="mobile-nav-toggler"><span class="icon flaticon-menu-2"></span><span
                        class="txt">@lang('advertising.menu')</span></div>
            </div>

            <div class="header-six__info">
                <a href="tel:{{$settings->phone}}" class="header-six__info__link">
                    <i class="flaticon-call"></i>
                    {{$settings->phone}}
                </a>

                <a href="mailto:{{$settings->email}}" class="header-six__info__link">
                    <i class="flaticon-email-2"></i>
                    {{$settings->email}}
                </a>
            </div>
        </div>
    </header>

    <nav class="mainmenu-six main-header" style="background-color: #18254f;">
        <div class="auto-container">
            <div class="mainmenu-six__inner nav-outer">
                <nav class="main-menu navbar-expand-md navbar-light">
                    <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                        <ul class="navigation clearfix">
                            <li>
                                <a href="#about_us">@lang('advertising.about_us')</a>
                            </li>
                            <li>
                                <a href="#our_teachers">@lang('advertising.our_teachers')</a>
                            </li>
                            <li>
                                <a href="#our_activities">@lang('advertising.our_activities')</a>
                            </li>
                            <li>
                                <a href="#educational_missions">@lang('advertising.educational_missions')</a>
                            </li>
                            <li>
                                <a href="#educational_vision">@lang('advertising.educational_vision')</a>
                            </li>
                            <li>
                                <a href="#trip">@lang('advertising.school_trip')</a>
                            </li>
                            <li>
                                <a href="{{route('privacy')}}">@lang('advertising.privacy')</a>
                            </li>
                            <li class="d-xl-none">
                                <a href="{{route('dashboard')}}">@lang('advertising.dashboard')</a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="mainmenu-six__right">
                    <a href="{{route('dashboard')}}"
                       class="thm-btn__six mainmenu-six__btn">@lang('advertising.dashboard')</a>
                </div>
            </div>
        </div>
    </nav>

    <!--Mobile Menu-->
    <div class="side-menu__block">


        <div class="side-menu__block-overlay custom-cursor__overlay">
            <div class="cursor"></div>
            <div class="cursor-follower"></div>
        </div>
        <div class="side-menu__block-inner ">
            <div class="side-menu__top justify-content-end">
                <a href="#" class="side-menu__toggler side-menu__close-btn">
                    <img src="website/images/icons/close-1-1.png" alt="">
                </a>
            </div>


            <nav class="mobile-nav__container">
                <!-- content is loading via js -->
            </nav>
            <div class="side-menu__sep"></div>
            <div class="side-menu__content">
                <p>
                    <a href="mailto:{{$settings->email}}">{{$settings->email}}</a> <br> <a
                        href="tel:{{$settings->phone}}">{{$settings->phone}}</a>
                </p>
            </div>
        </div>
    </div>

    <section class="about-seven" id="about_us">
        <div class="auto-container">
            <div class="row">
                <div class="col-md-12 col-lg-6 wow fadeInLeft" data-wow-duration="1500ms">
                    <div class="about-seven__images">
                        <img src="website/images/about_us.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="about-seven__content">
                        <div class="sec-title-six text-start">
                            <p class="sec-title-six__text"><span>@lang('advertising.about_us')</span></p>
                            <h6 class="sec-title-six__title">@lang('advertising.about_us_description')</h6>
                        </div>
                        <p class="about-seven__summery">{{$settings->about_us}} </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-six" id="educational_missions">
        <div class="about-six__curv">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 122">
                <path fill="currentColor"
                      d="M0,122.005S80.814,20.129,283.871,2.426C526.255-18.706,550.388,91.2,792.025,102.115c243.565,11.006,299.815-108,520.765-97.662,220.1,10.3,273.86,88.036,415.09,98.26C1878.57,113.62,1920,51.068,1920,51.068V-862.995H0v985Z"/>
            </svg>
        </div>
        <div class="auto-container">
            <div class="row">
                <div class="col-md-12 col-lg-5">
                    <div class="about-six__content">
                        <div class="sec-title-six">
                            <p class="sec-title-six__text"><span>@lang('advertising.schools_benefits')</span></p>
                            <h2 class="sec-title-six__title">@lang('advertising.educational_missions')</h2>
                        </div>
                        <div class="about-six__text"> {{ $settings->educational_missions }} </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-7 wow fadeInRight" data-wow-duration="1500ms">
                    <div class="about-six__image">
                        <img src="website/images/mission.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- /.video-seven -->
    <section class="video-seven" id="trip">
        <div class="video-seven__parallax  jarallax" data-jarallax data-speed="0.3" data-imgPosition="50% 80%">
            <img src="website/images/trip.jpg" class="jarallax-img" alt="">
        </div>
        <div class="auto-container">
            <h5 class="trip_title">@lang('advertising.school_trip')</h5>
            <h5 class="video-seven__title">{{$settings->trip_description}}</h5>
            <a href="{{$settings->link_trip}}" class="video-seven__btn lightbox-image">
                <i class="fa fa-play"></i>
                <i class="ripple"></i></a>
        </div>
    </section>

    <section class="project-six" id="our_activities">
        <div class="auto-container">
            <div class="sec-title-six text-center">
                <h2 class="sec-title-six__title">@lang('advertising.our_activities')</h2>
            </div>

            <div class="thm-swiper__slider swiper-container" data-swiper-options='{"spaceBetween": 2, "slidesPerView": 2, "autoplay": { "delay": 5000 }, "breakpoints": {
                    "0": {
                        "slidesPerView": 1
                    },
                    "375": {
                        "slidesPerView": 1
                    },
                    "480": {
                        "slidesPerView": 2
                    },
                    "767": {
                        "slidesPerView": 3
                    },
                    "1199": {
                        "slidesPerView": 4
                    }
                }}'>
                <div class="swiper-wrapper">
                    @foreach($activities as $activity)
                        <!-- /.swiper-slide -->
                        <div class="swiper-slide">
                            <div class="project-six__item">
                                <img src="{{$activity->image}}" class="activity-img">
                                <div class="project-six__content">
                                    <h2 class="project-six__title">{{$activity->name}}</h2>
                                    <p class="project-six__category">
                                        {{$activity->description}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- /.swiper-slide -->
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section no-padd-top" id="our_teachers">
        <div class="auto-container">
            <div class="sec-title centered">
                <h4><b>@lang('advertising.our_teachers')</b></h4>
            </div>
        </div>
        <div class="carousel-box">
            <div class="team-carousel owl-theme owl-carousel">
                @foreach($teachers as $teacher)
                    <!--Team-->
                    <div class="team-block">
                        <div class="inner-box">
                            <div class="image-box">
                                <img src="{{$teacher->teacher->image}}" alt="">
                                <ul class="social-links clearfix team_description">
                                    <li><span class="">@if($teacher->teacher->about_me)
                                                {{$teacher->teacher->about_me}}
                                            @else
                                                No teacher's CV added yet
                                            @endif  </span></li>
                                </ul>
                            </div>
                            <div class="lower-box">
                                <h5><b>{{$teacher->teacher->name}}</b></h5>
                                <div class="designation">{{$teacher->teacher->teacher_section}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- educational vision-->
    <section class="footer-six" id="educational_vision">
        <div class="auto-container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="footer-six__widget footer-six__about">
                        <a href="{{route('home')}}">
                            <img src="admin_panel/assets/images/full_logo.png" width="135" alt="">
                        </a>
                        <p class="footer-six__about__text">
                        <h5 class="footer_logo"> @lang('index.trkolej') </h5>
                        </p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <div class="footer-six__widget footer-six__links">
                        <h2 class="footer-six__title">@lang('advertising.educational_vision')</h2>
                        <div class="footer-six__links__list text-white">
                            <p>{{$settings->educational_vision}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
<!--End pagewrapper-->

<a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>


<script src="website/js/jquery.js"></script>
<script src="website/js/popper.min.js"></script>
<script src="website/js/bootstrap.min.js"></script>
<script src="website/js/TweenMax.js"></script>
<script src="website/js/jquery-ui.js"></script>
<script src="website/js/jquery.fancybox.js"></script>
<script src="website/js/owl.js"></script>
<script src="website/js/mixitup.js"></script>
<script src="website/js/appear.js"></script>
<script src="website/js/wow.js"></script>

<script src="website/js/jquery.easing.min.js"></script>
<script src="website/js/jarallax.min.js"></script>
<script src="website/js/swiper.min.js"></script>
<script src="website/js/custom-script.js"></script>


</body>

</html>
