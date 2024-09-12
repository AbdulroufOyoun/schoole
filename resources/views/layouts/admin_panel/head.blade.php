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
<title>@if($school){{$school->name}}@else @lang('index.trkolej') @endif </title>

<!--Favicon -->
<link rel="icon" href="{{ asset($logo) }}" type="image/x-icon">

<!-- Bootstrap css -->
<link href="{{ asset('admin_panel/assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

<!-- Style css -->
<link href="{{ asset('admin_panel/assets/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('admin_panel/assets/css/dark.css') }}" rel="stylesheet">
<link href="{{ asset('admin_panel/assets/css/skin-modes.css') }}" rel="stylesheet">

<!-- Animate css -->
<link href="{{ asset('admin_panel/assets/plugins/animated/animated.css') }}" rel="stylesheet">

<!--Sidemenu css -->
<link href="{{ asset('admin_panel/assets/css/sidemenu.css') }}" rel="stylesheet">

<!-- P-scroll bar css-->
<link href="{{ asset('admin_panel/assets/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet">

<!---Icons css-->
<link href="{{ asset('admin_panel/assets/plugins/icons/icons.css') }}" rel="stylesheet">

<!---Sidebar css-->
<link href="{{ asset('admin_panel/assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">

<!-- Select2 css -->
<link href="{{ asset('admin_panel/assets/plugins/select2/select2.min.css') }}" rel="stylesheet">


<!--- INTERNAL jvectormap css-->
<link href="{{ asset('admin_panel/assets/plugins/jvectormap/jqvmap.css') }}" rel="stylesheet">

<!-- INTERNAL Data table css -->
<link href="{{ asset('admin_panel/assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<!-- INTERNAL Time picker css -->
<link href="{{ asset('admin_panel/assets/plugins/time-picker/jquery.timepicker.css') }}" rel="stylesheet">

<!-- INTERNAL jQuery-countdowntimer css -->
<link href="{{ asset('admin_panel/assets/plugins/jQuery-countdowntimer/jQuery.countdownTimer.css') }}" rel="stylesheet">


<!-- INTERNAL Switcher css -->
<link href="{{ asset('admin_panel/assets/switcher/css/switcher.css') }}" rel="stylesheet">
<link href="{{ asset('admin_panel/assets/switcher/demo.css') }}" rel="stylesheet">

{{-- our css --}}
<link href="{{ asset('admin_panel/assets/css/ourStyle.css') }}" rel="stylesheet">

<!-- INTERNAL Fancy File Upload css -->
<link href="{{ asset('admin_panel/assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet">
<!-- INTERNAL File Uploads css-->
<link href="{{ asset('admin_panel/assets/plugins/fileupload/css/fileupload.css') }}" rel="stylesheet" type="text/css">


@livewireStyles


{{-- jquery --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


{{-- bootstap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>


<!-- INTERNAL Data table css -->
<link href="{{asset('admin_panel/assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
{{--<link href="{{asset('admin_panel')}}/assets/plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet">--}}
<link href="{{asset('admin_panel/assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet">



@stack('style')
