@extends('layouts.admin_panel.main')
@section('header')
    {{$school->name }} @lang('schools.settings')
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
            <form class="form-horizontal" action="{{ route('settings.school-update') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <h4 class="card-title">@lang('schools.settings')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-3 form-label" for="name">@lang('schools.name')</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" id="name"
                                               value="{{ $school->name }}">
                                        @error('name')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">
                                            {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-3 form-label" for="welcome_screen">@lang('schools.welcome_screen')</label>
                                    <div class="col-md-9">
                                        <input type="text" id="welcome_screen" name="welcome_screen"
                                               class="form-control"
                                               value="{{ $school->welcome_screen }}">
                                        @error('welcome_screen')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">
                                            {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header border-bottom-0"></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-3 form-label" for="logo">@lang('schools.logo') :</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control dropify" id="logo" name="logo"
                                               data-height="180"
                                               data-default-file="{{ asset($school->logo)  }}">
                                        @error('logo')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">
                                            {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-2 form-label" for="about_us">@lang('schools.about_us')</label>
                                    <div class="col-md-10">
                                    <textarea class="form-control" name="about_us"
                                              rows="7" id="about_us">{{ $school->about_us }}</textarea>
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
