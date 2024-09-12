<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta
        content="DayOne - It is one of the Major Dashboard Template which includes - HR, Employee and Job Dashboard. This template has multipurpose HTML template and also deals with Task, Project, Client and Support System Dashboard."
        name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords"
          content="admin dashboard, dashboard ui, backend, admin panel, admin template, dashboard template, admin, bootstrap, laravel, laravel admin panel, php admin panel, php admin dashboard, laravel admin template, laravel dashboard, laravel admin panel">
    @php
        $logo = \App\Models\Setting::first()->dark_logo;
    @endphp
        <!-- Title -->
    <title>Berneshti</title>

    <!--Favicon -->
    <link rel="icon" href="{{ asset($logo) }}" type="image/x-icon">

    <!-- Bootstrap css -->
    <link href="{{asset('admin_panel')}}/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Style css -->
    <link href="{{asset('admin_panel')}}/assets/css/style.css" rel="stylesheet">
    <link href="{{asset('admin_panel')}}/assets/css/dark.css" rel="stylesheet">
    <link href="{{asset('admin_panel')}}/assets/css/skin-modes.css" rel="stylesheet">

    <!-- Animate css -->
    <link href="{{asset('admin_panel')}}/assets/plugins/animated/animated.css" rel="stylesheet">

    <!---Icons css-->
    <link href="{{asset('admin_panel')}}/assets/plugins/icons/icons.css" rel="stylesheet">

    <!-- Select2 css -->
    <link href="{{asset('admin_panel')}}/assets/plugins/select2/select2.min.css" rel="stylesheet">

    <!-- P-scroll bar css-->
    <link href="{{asset('admin_panel')}}/assets/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet">



    <!-- INTERNAL Switcher css -->
    <link href="{{asset('admin_panel')}}/assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="{{asset('admin_panel')}}/assets/switcher/demo.css" rel="stylesheet">

</head>

<body>



<div class="page error-bg">
    <div class="page-content m-0">
        <div class="container text-center">
            <div class="display-1 text-primary mb-5 font-weight-bold">4<span class="fa fa-smile-o"></span>4</div>
            <h1 class="h3  mb-3 font-weight-semibold">Sorry, an error has occured, Requested Page not found!</h1>
            <p class="h5 font-weight-normal mb-7 leading-normal">You may have mistyped the address or the page may have moved.</p>
            <a class="btn btn-primary" href="{{route('dashboard')}}"><i class="fe fe-arrow-left-circle mr-1"></i>Back to Home</a>
        </div>
    </div>
</div>


<!-- Jquery js-->
<script src="{{asset('admin_panel')}}/assets/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap4 js-->
<script src="{{asset('admin_panel')}}/assets/plugins/bootstrap/popper.min.js"></script>
<script src="{{asset('admin_panel')}}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>



<!-- Select2 js -->
<script src="{{asset('admin_panel')}}/assets/plugins/select2/select2.full.min.js"></script>

<!-- P-scroll js-->
<script src="{{asset('admin_panel')}}/assets/plugins/p-scrollbar/p-scrollbar.js"></script>

<!-- Custom js-->
<script src="{{asset('admin_panel')}}/assets/js/custom.js"></script>

<!-- Switcher js -->
<script src="{{asset('admin_panel')}}/assets/switcher/js/switcher.js"></script>

</body>
</html>
