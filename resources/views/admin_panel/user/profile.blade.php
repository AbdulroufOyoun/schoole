@extends('layouts.admin_panel.main')
@section('header')
    @lang('user.update_the_account')
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
    <div>
        <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
            <div class="tab-content">
                <div class="tab-pane active" id="tab5">
                    <form action="{{ route('user.update-profile') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="card-body">
                            <h4 class="mb-4 font-weight-bold">@lang('user.user_account') </h4>
                            @if ($user->image)
                                <div class="form-group">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <img src="{{ asset($user->image) }}" class="img-fluid"
                                                 style="max-height: 30ch;">
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">@lang('user.fist_name')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control mb-md-0 mb-5" placeholder="@lang('user.fist_name')"
                                                       name="name" value="{{ $user->name }}">
                                                @error('name')
                                                <span class="text-danger">{{ $message}}</span>
                                                @enderror
                                                <span class="text-muted"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">@lang('user.last_name')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control mb-md-0 mb-5" placeholder="@lang('user.last_name')"
                                                       name="last_name" value="{{ $user->last_name }}">
                                                @error('last_name')
                                                <span class="text-danger">{{ $message}}</span>
                                                @enderror
                                                <span class="text-muted"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">@lang('user.phone')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="@lang('user.phone')" name="phone"
                                               value="{{ $user->phone }}">
                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-label mb-0 mt-2">@lang('user.upload_photo')</div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group file-browser">
                                            <input type="text" class="form-control border-right-0 browse-file"
                                                   placeholder="@lang('user.choose')" readonly="" name="image">
                                            <label class="input-group-append mb-0">
                                            <span class="btn ripple btn-primary">
                                                @lang('user.browse') <input type="file" class="file-browserinput"
                                                              style="display: none;" name="image">
                                            </span>
                                            </label>
                                            @error('image') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="mb-5 mt-7 font-weight-bold">@lang('user.account_login')</h4>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">@lang('user.email')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" placeholder="@lang('user.email')" name="email"
                                               value="{{ $user->email }}">
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">@lang('user.password')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" placeholder="@lang('user.password')"
                                               name="password">
                                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input name="id" value="{{$user->id}}" type="hidden">
                        <div class="card-footer text-left">
                            <button type="submit" class="btn btn-primary">@lang('button.update')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
