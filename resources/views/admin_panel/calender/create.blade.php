@extends('layouts.admin_panel.main')
@section('header')
    @lang('plans.calendarTitle')
@endsection

@section('content')
    @push('style')
        <!-- INTERNAL Time picker css -->
        <link href="{{asset('admin_panel/assets/plugins/time-picker/jquery.timepicker.css')}}" rel="stylesheet">

        <!-- INTERNAL Date Picker css -->
        <link href="{{asset('admin_panel/assets/plugins/date-picker/date-picker.css')}}" rel="stylesheet">

    @endpush

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" action="{{ route('calender.store') }}">
                            @csrf
                            <div class="form-group ">
                                <label class="form-label">@lang('plans.start_at')</label>
                                <input class="form-control" type="datetime-local" name="start_at">
                                @error('start_at')
                                <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                    {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-group ">
                                    <label class="form-label">@lang('plans.end_at')</label>
                                    <input class="form-control" type="datetime-local" name="end_at">
                                    @error('end_at')
                                    <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                        {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group ">
                                    <label class="form-label">@lang('plans.description')</label>
                                    <input class="form-control" type="text" name="description">
                                    @error('description')
                                    <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                        {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group ">
                                    <label class="form-label">@lang('plans.color')</label>
                                    <input class="form-control" name="color" id="colorpicker" type="text">
                                    @error('color')
                                    <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                        {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">@lang('button.save')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('js')
        <!-- INTERNAL Datepicker js -->
        <script src="{{asset('admin_panel')}}/assets/plugins/date-picker/date-picker.js"></script>
        <script src="{{asset('admin_panel')}}/assets/plugins/date-picker/jquery-ui.js"></script>
        <script src="{{asset('admin_panel')}}/assets/plugins/input-mask/jquery.maskedinput.js"></script>

        <!-- INTERNAL Form Advanced Element -->
        <script src="{{asset('admin_panel')}}/assets/js/formelementadvnced.js"></script>
        <script src="{{asset('admin_panel')}}/assets/js/form-elements.js"></script>
        <script src="{{asset('admin_panel')}}/assets/js/select2.js"></script>

    @endpush

@endsection
