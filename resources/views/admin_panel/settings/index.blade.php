@extends('layouts.admin_panel.main')
@section('header')
    @lang('schools.settings')
@endsection
@section('content')
    <div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <button class="close" data-dismiss="alert"
                        aria-hidden="true">×
                </button> {{ session('success') }}</div>
        @endif
    </div>
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <form class="form-horizontal" action="{{ route('settings.update') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <h4 class="card-title">@lang('schools.contact_settings')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-3 form-label" for="example-email">@lang('user.email')</label>
                                    <div class="col-md-9">
                                        <input type="email" id="example-email" name="email" class="form-control"
                                               value="{{ $settings->email }}">
                                        @error('email')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">
                                            {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-3 form-label" for="example-email">@lang('user.phone')</label>
                                    <div class="col-md-9">
                                        <input type="text" id="example-email" name="phone" class="form-control"
                                               value="{{ $settings->phone }}">
                                        @error('phone')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">
                                            {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header border-bottom-0">
                        <h4 class="card-title">@lang('schools.advertising_settings')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-3 form-label" for="trip_description">@lang('schools.trip_description')</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="trip_description"
                                               value="{{ $settings->trip_description }}" id="trip_description">
                                        @error('trip_description')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">
                                            {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-3 form-label" for="link_trip">@lang('schools.trip_link')</label>
                                    <div class="col-md-9">
                                        <input type="url" class="form-control" name="link_trip"
                                               value="{{ $settings->link_trip }}" id="link_trip">
                                        @error('link_trip')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">
                                            {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-3 form-label" for="educational_missions">@lang('schools.educational_mission')</label>
                                    <div class="col-md-9">
                                    <textarea class="form-control" name="educational_missions" id="educational_missions"
                                              rows="5">{{ $settings->educational_missions }}</textarea>
                                        @error('educational_missions')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">
                                            {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-3 form-label" for="educational_vision">@lang('schools.educational_vision')</label>
                                    <div class="col-md-9">
                                    <textarea class="form-control" name="educational_vision"
                                              rows="5"
                                              id="educational_vision">{{ $settings->educational_vision }}</textarea>
                                        @error('educational_vision')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">
                                            {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header border-bottom-0">
                        <h4 class="card-title">@lang('schools.about_us')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-2 form-label" for="about_us">@lang('schools.logo')</label>
                                    <div class="col-md-10">
                                    <textarea class="form-control" name="about_us"
                                              rows="5" id="about_us">{{ $settings->about_us }}</textarea>
                                        @error('about_us')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">
                                            {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br><br>
                    <div class="col-lg-12 col-md-12 mx-auto text-center">
                        <button type="submit" class="btn btn-primary mb-2" style="width: 10ch;">@lang('button.update')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
