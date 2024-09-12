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
    <link href="website/css/style.css?v=2" rel="stylesheet">
    <link href="website/css/privacy.css" rel="stylesheet">
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

    <style>
        h3,h4 {
            font-family: Georgia, serif;
        }
        p {
            font-size: 17px;
        }

       .events-details ol li {
            list-style-type: decimal;
        }

    </style>
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
                        <ol class="navigation clearfix">
                            <li>
                                <a href="{{route('home')}}">@lang('advertising.about_us')</a>
                            </li>
                            <li>
                                <a href="{{route('home')}}">@lang('advertising.our_teachers')</a>
                            </li>
                            <li>
                                <a href="{{route('home')}}">@lang('advertising.our_activities')</a>
                            </li>
                            <li>
                                <a href="{{route('home')}}">@lang('advertising.educational_missions')</a>
                            </li>
                            <li>
                                <a href="{{route('home')}}">@lang('advertising.educational_vision')</a>
                            </li>
                            <li>
                                <a href="{{route('home')}}">@lang('advertising.school_trip')</a>
                            </li>
                            <li>
                                <a href="{{route('privacy')}}">@lang('advertising.privacy')</a>
                            </li>
                            <li class="d-xl-none">
                                <a href="{{route('dashboard')}}">@lang('advertising.dashboard')</a>
                            </li>
                        </ol>
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

    <!-- Banner Section -->
    <section class="page-banner">
        <div class="image-layer" style="background-image:url(website/images/background/image-7.jpg);"></div>
        <div class="shape-1"></div>
        <div class="shape-2"></div>
        <div class="banner-inner">
            <div class="auto-container">
                <div class="inner-container clearfix">
                    <h3 class="text-white">@lang('privacy.banner')</h3>
                </div>
            </div>
        </div>
    </section>


    <!--End Banner Section -->
    <section class="events-details">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="events-details__content">
                        <h3 class="events-one__title">
                            @lang('privacy.title1')
                        </h3>
                        <p>
                            @lang('privacy.description1_1')
                        </p>
                        <p>
                            @lang('privacy.description1_2')
                        </p>
                        <p>
                            @lang('privacy.description1_3')
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="events-details__content">
                        <h3 class="events-one__title">
                            Interpretation and Definitions
                        </h3>
                        <h5>@lang('privacy.title2')</h5>
                        <p>@lang('privacy.description2_1')</p>
                        <br>
                        <h5>@lang('privacy.description2_2')</h5>
                        <p>@lang('privacy.description2_3')</p>
                        <ol>
                            <li>
                                <p><strong>@lang('privacy.description2_4')</strong>@lang('privacy.description2_5')</p>
                            </li>
                            <li>
                                <p><strong>@lang('privacy.description2_6')</strong>@lang('privacy.description2_7')</p>
                            </li>
                            <li>
                                <p><strong>@lang('privacy.description2_9')</strong>@lang('privacy.description2_10')</p>
                            </li>
                            <li>
                                <p><strong>@lang('privacy.description2_11')</strong> @lang('privacy.description2_12')</p>
                            </li>
                            <li>
                                <p><strong>@lang('privacy.description2_13')</strong>@lang('privacy.description2_14')</p>
                            </li>
                            <li>
                                <p><strong>@lang('privacy.description2_15')</strong>@lang('privacy.description2_16')</p>
                            </li>
                            <li>
                                <p><strong>@lang('privacy.description2_17')</strong>@lang('privacy.description2_18')</p>
                            </li>
                            <li>
                                <p><strong>@lang('privacy.description2_19')</strong>@lang('privacy.description2_20')</p>
                            </li>
                            <li>
                                <p><strong>@lang('privacy.description2_21')</strong>@lang('privacy.description2_22')</p>
                            </li>
                            <li>
                                <p><strong>@lang('privacy.description2_23')</strong>@lang('privacy.description2_24')</p>
                            </li>
                            <li>
                                <p><strong>@lang('privacy.description2_25')</strong>@lang('privacy.description2_26')
                                    <a href="https://trkolej.com/" rel="external nofollow noopener" target="_blank">https://trkolej.com/</a></p>
                            </li>
                            <li>
                                <p><strong>@lang('privacy.description2_4')</strong>@lang('privacy.description2_28')</p>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="events-details__content">
                        <h3 class="events-one__title">
                            @lang('privacy.title3')
                        </h3>
                        <h5>@lang('privacy.description3_1')</h5>
                        <h6>@lang('privacy.description3_2')</h6>
                        <p>@lang('privacy.description3_3')</p>
                    </div>
                    <ol>
                        <li>
                            @lang('privacy.description3_4')
                        </li>
                        <li>
                            @lang('privacy.description3_5')
                        </li>
                        <li>
                            @lang('privacy.description3_6')
                        </li>
                        <li>
                            @lang('privacy.description3_7')
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="events-details__content">
                        <h3 class="events-one__title">
                            @lang('privacy.title4')
                        </h3>
                        <p>@lang('privacy.description4_1')</p>
                        <p>@lang('privacy.description4_2')</p>
                        <p>@lang('privacy.description4_3')</p>
                        <p>@lang('privacy.description4_4')</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="events-details__content">
                        <h3 class="events-one__title">
                            @lang('privacy.title5')
                        </h3>
                        <p>@lang('privacy.description5_1')</p>
                        <ol>
                            <li><strong>@lang('privacy.description5_2')</strong>@lang('privacy.description5_3')</li>
                            <li><strong>@lang('privacy.description5_4')</strong>@lang('privacy.description5_5')</li>
                        </ol>
                        <p>@lang('privacy.description5_6')
                            <a href="https://www.freeprivacypolicy.com/blog/sample-privacy-policy-template/#Use_Of_Cookies_And_Tracking"
                                target="_blank">@lang('privacy.description5_7')</a>@lang('privacy.description5_8')</p>
                        <p>@lang('privacy.description5_9')</p>
                        <ol>
                            <li>
                                <strong>@lang('privacy.description5_10')</strong>
                                @lang('privacy.description5_11')<br>
                                @lang('privacy.description5_12')<br>
                                <p>@lang('privacy.description5_13')</p>
                            </li>
                            <li>
                                <strong>@lang('privacy.description5_14')</strong>
                                @lang('privacy.description5_15')<br>
                                @lang('privacy.description5_16')<br>
                                @lang('privacy.description5_17')
                            </li>
                            <li>
                                <strong>@lang('privacy.description5_18')</strong>
                                @lang('privacy.description5_19')<br>
                                @lang('privacy.description5_20')<br>
                                <p>@lang('privacy.description5_21')</p>
                            </li>
                        </ol>
                        <p>@lang('privacy.description5_22')</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="events-details__content">
                        <h3 class="events-one__title">
                            @lang('privacy.title6')
                        </h3>
                        <p>@lang('privacy.description6_1')</p>
                        <ol>
                            <li>
                                <p><strong>@lang('privacy.description6_2'),</strong>@lang('privacy.description6_3')</p>
                            </li>
                            <li>
                                <p><strong>@lang('privacy.description6_4')</strong>@lang('privacy.description6_5')</p>
                            </li>
                            <li>
                                <p><strong>@lang('privacy.description6_6')</strong> @lang('privacy.description6_7')</p>
                            </li>
                            <li>
                                <p><strong>@lang('privacy.description6_8')</strong> @lang('privacy.description6_9')</p>
                            </li>
                            <li>
                                <p><strong>@lang('privacy.description6_10')</strong>@lang('privacy.description6_11')</p>
                            </li>
                            <li>
                                <p><strong>@lang('privacy.description6_12')</strong>@lang('privacy.description6_13')</p>
                            </li>
                            <li>
                                <p><strong>@lang('privacy.description6_14')</strong>@lang('privacy.description6_15')</p>
                            </li>
                            <li>
                                <p><strong>@lang('privacy.description6_16')</strong>@lang('privacy.description6_17')</p>
                            </li>
                        </ol>
                        <p>@lang('privacy.description6_18')</p>
                        <ol>
                            <li><strong>@lang('privacy.description6_19')</strong> @lang('privacy.description6_20')</li>

                            <li><strong>@lang('privacy.description6_21')</strong>@lang('privacy.description6_22')</li>

                            <li><strong>@lang('privacy.description6_23')</strong>@lang('privacy.description6_24')</li>

                            <li><strong>@lang('privacy.description6_25')</strong>@lang('privacy.description6_26')</li>

                            <li><strong>@lang('privacy.description6_27')</strong>@lang('privacy.description6_28')</li>

                            <li><strong>@lang('privacy.description6_29')</strong>@lang('privacy.description6_30')</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="events-details__content">
                        <h3 class="events-one__title">
                            @lang('privacy.title7')
                        </h3>
                        <p>@lang('privacy.description7_1')</p>
                        <p>@lang('privacy.description7_2')</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="events-details__content">
                        <h3 class="events-one__title">
                            @lang('privacy.title8')
                        </h3>
                        <p>@lang('privacy.description8_1')</p>
                        <p>@lang('privacy.description8_2')</p>
                        <p>@lang('privacy.description8_3')</p>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="events-details__content">
                        <h3 class="events-one__title">
                            @lang('privacy.title9')
                        </h3>
                        <p>@lang('privacy.description9_1')
                            </p>
                        <p>@lang('privacy.description9_2')</p>
                        <p>@lang('privacy.description9_3')</p>
                        <p>@lang('privacy.description9_4')</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="events-details__content">
                        <h3 class="events-one__title">
                            @lang('privacy.title10')
                        </h3>
                        <h4>@lang('privacy.description10_1')</h4>
                        <p>@lang('privacy.description10_2')</p>
                        <h4>@lang('privacy.description10_3')</h4>
                        <p>@lang('privacy.description10_4')</p>
                        <h4>@lang('privacy.description10_5')</h4>
                        <p>@lang('privacy.description10_6')</p>
                        <ol>
                            <li>@lang('privacy.description10_7')</li>
                            <li>@lang('privacy.description10_8')</li>
                            <li>@lang('privacy.description10_9')</li>
                            <li>@lang('privacy.description10_10')</li>
                            <li>@lang('privacy.description10_11')</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="events-details__content">
                        <h3 class="events-one__title">
                            @lang('privacy.title11')
                        </h3>
                        <p>@lang('privacy.description11_1')</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="events-details__content">
                        <h3 class="events-one__title">
                            @lang('privacy.title12')
                        </h3>
                        <p>@lang('privacy.description12_1')</p>
                        <p>@lang('privacy.description12_2')</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="events-details__content">
                        <h3 class="events-one__title">
                            @lang('privacy.title13')
                        </h3>
                        <p>@lang('privacy.description13_1')</p>
                        <p>@lang('privacy.description13_2')</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="events-details__content">
                        <h3 class="events-one__title">
                            @lang('privacy.title14')
                        </h3>
                        <p>@lang('privacy.description14_1')</p>
                        <p>@lang('privacy.description14_2')</p>
                        <p>@lang('privacy.description14_3')</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="events-details__content">
                        <h3 class="events-one__title">
                            @lang('privacy.title15')
                        </h3>
                        <p>@lang('privacy.description15_1')</p>
                        <p class="ml-4 mr-4">@lang('privacy.description15_2')<a href="mailto:info@trkolej.com"> info@trkolej.com </a></p>
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
