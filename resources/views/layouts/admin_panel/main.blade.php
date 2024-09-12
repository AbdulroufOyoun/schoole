<!DOCTYPE html>
<html lang="en" dir="ltr">
@php
    $user = auth()->user();
    $school = $user->school;
    $logo = $user->role_id == 10 ? asset('admin_panel/assets/images/full_logo.png') : $school->logo ;
@endphp

<head>
    @include('layouts.admin_panel.head')
</head>

<body class="app sidebar-mini" id="index1">

<!---Global-loader-->
<div id="global-loader">
    <img src="{{ asset('admin_panel/assets/images/svgs/loader.svg') }}" alt="loader">
</div>

<div class="page">
    <div class="page-main">

        <!--aside open-->
        @include('layouts.admin_panel.sidebar')
        <!--aside closed-->

        <div class="app-content main-content">
            <div class="side-app">

                <!--app header-->
                @include('layouts.admin_panel.navbar')
                <!--/app header-->


                <!--Page header-->
                <div class="page-leftheader" style="margin: 2ch 0 ;">
                    <h4 class="page-title">@yield('header')
                    </h4>
                </div>
                <div class="page-leftheader">

                </div>

                <!--End Page header-->


                <!--cintent-->
                @yield('content')


            </div>
        </div><!-- end app-content-->
    </div>


    <!--Sidebar-right-->

    @include('layouts.admin_panel.sideright')
    <!-- End Change password Modal  -->

    <!--/Sidebar-right-->


</div>

@include('layouts.admin_panel.js')

</body>

</html>

