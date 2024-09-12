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

    <!-- Title -->
    <title>@lang('index.trkolej')</title>

    <!--Favicon -->
    <link rel="icon" href="{{ asset('admin_panel/assets/images/full_logo.png') }}" type="image/x-icon">

    <!-- Bootstrap css -->
    <link href="{{ asset('admin_panel/assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Style css -->
    <link href="{{ asset('admin_panel/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_panel/assets/css/dark.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_panel/assets/css/skin-modes.css') }}" rel="stylesheet">

    <!-- Animate css -->
    <link href="{{ asset('admin_panel/assets/plugins/animated/animated.css') }}" rel="stylesheet">

    <!---Icons css-->
    <link href="{{ asset('admin_panel/assets/plugins/icons/icons.css') }}" rel="stylesheet">

    <!-- Select2 css -->
    <link href="{{ asset('admin_panel/assets/plugins/select2/select2.min.css') }}" rel="stylesheet">

    <!-- P-scroll bar css-->
    <link href="{{ asset('admin_panel/assets/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet">


    <!-- INTERNAL Switcher css -->
    <link href="{{ asset('admin_panel/assets/switcher/css/switcher.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_panel/assets/switcher/demo.css') }}" rel="stylesheet">

</head>

<body>


<div class="page login-bg1">
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col-md-5 p-md-0">
                    <div class="card p-5">
                        <div class="pl-4 pt-4 pb-2">
                            <a class="header-brand" href="{{route('dashboard')}}">
                                <img src="{{ asset('admin_panel/assets/images/full_logo.png') }}"
                                     class="header-brand-img custom-logo" style="max-width: 15ch;" alt="TR KOLEJ">
                                <img src="{{ asset('admin_panel/assets/images/full_logo.png') }}"
                                     class="header-brand-img custom-logo-dark" alt="TR KOLEJ"
                                     style="max-width: 15ch;">
                            </a>
                        </div>
                        <div class="p-5 pt-0">
                            <h1 class="mb-2">@lang('user.login')</h1>
                            <p class="text-muted">@lang('user.sign_in')</p>
                        </div>
                        <form class="card-body pt-3" id="login" name="login" method="POST"
                              action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">@lang('user.email')</label>
                                <input class="form-control" placeholder="@lang('user.email')" type="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">@lang('user.password')</label>
                                <input class="form-control" placeholder="@lang('user.password')" type="password" name="password"
                                       required>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="submit">
                                <button class="btn btn-primary btn-block" type="submit">@lang('user.login')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Jquery js-->
<script src="{{ asset('admin_panel/assets/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap4 js-->
<script src="{{ asset('admin_panel/assets/plugins/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('admin_panel/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>


<!-- Select2 js -->
<script src="{{ asset('admin_panel/assets/plugins/select2/select2.full.min.js') }}"></script>

<!-- P-scroll js-->
<script src="{{ asset('admin_panel/assets/plugins/p-scrollbar/p-scrollbar.js') }}"></script>

<!-- Custom js-->
<script src="{{ asset('admin_panel/assets/js/custom.js') }}"></script>

<!-- Switcher js -->
<script src="{{ asset('admin_panel/assets/switcher/js/switcher.js') }}"></script>

</body>
</html>
