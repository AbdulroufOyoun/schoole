<!-- Back to top -->
<a href="#top" id="back-to-top"><span class="feather feather-chevrons-up"></span></a>

<!--Moment js-->
<script src="{{ asset('admin_panel') }}/assets/plugins/moment/moment.js"></script>

<!-- Jquery js-->
<script src="{{ asset('admin_panel') }}/assets/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap4 js-->
<script src="{{ asset('admin_panel') }}/assets/plugins/bootstrap/popper.min.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!--Othercharts js-->
<script src="{{ asset('admin_panel') }}/assets/plugins/othercharts/jquery.sparkline.min.js"></script>

<!-- Circle-progress js-->
<script src="{{ asset('admin_panel') }}/assets/plugins/circle-progress/circle-progress.min.js"></script>

<!--Sidemenu js-->
<script src="{{ asset('admin_panel') }}/assets/plugins/sidemenu/sidemenu.js"></script>

<!-- P-scroll js-->
<script src="{{ asset('admin_panel') }}/assets/plugins/p-scrollbar/p-scrollbar.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/p-scrollbar/p-scroll1.js"></script>

<!--Sidebar js-->
<script src="{{ asset('admin_panel') }}/assets/plugins/sidebar/sidebar.js"></script>

<!-- Select2 js -->
<script src="{{ asset('admin_panel') }}/assets/plugins/select2/select2.full.min.js"></script>


<!-- INTERNAL Peitychart js-->
<script src="{{ asset('admin_panel') }}/assets/plugins/peitychart/jquery.peity.min.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/peitychart/peitychart.init.js"></script>

<!-- INTERNAL Apexchart js-->
<script src="{{ asset('admin_panel') }}/assets/plugins/apexchart/apexcharts.js"></script>

<!-- INTERNAL Vertical-scroll js-->
<script src="{{ asset('admin_panel') }}/assets/plugins/vertical-scroll/jquery.bootstrap.newsbox.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/vertical-scroll/vertical-scroll.js"></script>

<!-- INTERNAL  Datepicker js -->
<script src="{{ asset('admin_panel') }}/assets/plugins/date-picker/jquery-ui.js"></script>

<!-- INTERNAL Chart js -->
<script src="{{ asset('admin_panel') }}/assets/plugins/chart/chart.bundle.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/chart/utils.js"></script>

<!-- INTERNAL Timepicker js -->
<script src="{{ asset('admin_panel') }}/assets/plugins/time-picker/jquery.timepicker.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/time-picker/toggles.min.js"></script>

<!-- INTERNAL Chartjs rounded-barchart -->
<script src="{{ asset('admin_panel') }}/assets/plugins/chart.min/chart.min.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/chart.min/rounded-barchart.js"></script>

<!-- INTERNAL jQuery-countdowntimer js -->
<script src="{{ asset('admin_panel') }}/assets/plugins/jQuery-countdowntimer/jQuery.countdownTimer.js"></script>

<!-- INTERNAL Index js-->
<script src="{{ asset('admin_panel') }}/assets/js/index1.js"></script>


<!-- Custom js-->
<script src="{{ asset('admin_panel') }}/assets/js/custom.js"></script>

<!-- Switcher js -->
<script src="{{ asset('admin_panel') }}/assets/switcher/js/switcher.js"></script>

<!-- INTERNAL File-Uploads Js-->
<script src="{{ asset('admin_panel') }}/assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/fancyuploder/jquery.fileupload.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/fancyuploder/fancy-uploader.js"></script>

<!-- INTERNAL File uploads js -->
<script src="{{ asset('admin_panel') }}/assets/plugins/fileupload/js/dropify.js"></script>
<script src="{{ asset('admin_panel') }}/assets/js/filupload.js"></script>


@livewireScripts

{{-- livewire select 2 --}}
<script src="{{ asset('vendor/pharaonic/pharaonic.select2.min.js') }}"></script>


{{-- sweet alert --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

{{--<!-- INTERNAL Data tables -->--}}
<script src="{{ asset('admin_panel') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/datatable/js/dataTables.bootstrap4.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/datatable/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/datatable/js/jszip.min.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/datatable/js/buttons.html5.min.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/datatable/js/buttons.print.min.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/datatable/js/buttons.colVis.min.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/datatable/dataTables.responsive.min.js"></script>
<script src="{{ asset('admin_panel') }}/assets/plugins/datatable/responsive.bootstrap4.min.js"></script>
{{--<script src="{{ asset('admin_panel') }}/assets/js/datatables.js"></script>--}}

<script>
    $(document).ready(function () {
        $('#details-datatable').dataTable();
    });
</script>


@stack('js')
