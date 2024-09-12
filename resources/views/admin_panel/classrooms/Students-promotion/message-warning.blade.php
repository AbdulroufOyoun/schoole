<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>



		<!-- Bootstrap css -->
		<link href="{{ asset('admin_panel') }}/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

		<!-- Style css -->
		<link href="{{ asset('admin_panel') }}/assets/css/style.css" rel="stylesheet">
		<link href="{{ asset('admin_panel') }}/assets/css/dark.css" rel="stylesheet">
		<link href="{{ asset('admin_panel') }}/assets/css/skin-modes.css" rel="stylesheet">

		<!-- Animate css -->
		<link href="{{ asset('admin_panel') }}/assets/plugins/animated/animated.css" rel="stylesheet">

		<!---Icons css-->
		<link href="{{ asset('admin_panel') }}/assets/plugins/icons/icons.css" rel="stylesheet">

		<!-- Select2 css -->
		<link href="{{ asset('admin_panel') }}/assets/plugins/select2/select2.min.css" rel="stylesheet">

		<!-- P-scroll bar css-->
		<link href="{{ asset('admin_panel') }}/assets/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet">



        <!-- INTERNAL Switcher css -->
		<link href="assets/switcher/css/switcher.css" rel="stylesheet">
		<link href="assets/switcher/demo.css" rel="stylesheet">

	</head>

	<body>



		<!-- Page opened -->
		<div class="page message-bg">
			<div class="container">
				<div class="row">
					<div class="col-md-6 justify-content-center mx-auto text-center">
						<div class="card">
							<div class="card-body p-8 text-center">
								<img src="{{ asset('admin_panel') }}/assets/images/svgs/warning.svg" alt="img" class="w-15">
								<h2 class="mt-5">@lang('alert.message_warning')</h2>
								<h4 class="mt-3 mb-5"> @lang('alert.activation')</h4>
								<a class="btn ripple btn-success" href="{{ route('settings.year.activation',$year_id) }}">@lang('button.confirm')</a>
                                <a class="btn ripple btn-light" href="{{ route('settings.year.activation') }}">@lang('button.cancel')</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Page closed -->


        <!-- Jquery js-->
		<script src="{{ asset('admin_panel') }}/assets/plugins/jquery/jquery.min.js"></script>

		<!-- Bootstrap4 js-->
		<script src="{{ asset('admin_panel') }}/assets/plugins/bootstrap/popper.min.js"></script>
		<script src="{{ asset('admin_panel') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>



		<!-- Select2 js -->
		<script src="{{ asset('admin_panel') }}/assets/plugins/select2/select2.full.min.js"></script>

		<!-- P-scroll js-->
		<script src="{{ asset('admin_panel') }}/assets/plugins/p-scrollbar/p-scrollbar.js"></script>

		<!-- Custom js-->
		<script src="{{ asset('admin_panel') }}/assets/js/custom.js"></script>

        <!-- Switcher js -->
		<script src="{{ asset('admin_panel') }}/assets/switcher/js/switcher.js"></script>

	</body>
</html>
