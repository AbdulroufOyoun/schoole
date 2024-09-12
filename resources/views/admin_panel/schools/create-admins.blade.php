@extends('layouts.admin_panel.main')
@section('header')
    @lang('schools.create_admin_account')
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

    <div>
        <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
            <div class="tab-content">
                <div class="tab-pane active" id="tab5">
                    <form action="{{ route('schools.store-admin') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="card-body">
                            <h4 class="mb-4 font-weight-bold">@lang('schools.school_admin_account') </h4>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2" for="school_id">@lang('schools.name')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control custom-select select2 mySelect2" name="school_id" id="school_id" required>
                                            <option label="@lang('button.select')"></option>
                                            @foreach ($schools as $school)
                                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div style="margin-left: 26%">
                                        @error('classroom') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">@lang('user.fist_name')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control mb-md-0 mb-5"
                                                       placeholder="@lang('user.fist_name')" name="name" required>
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
                                                <input type="text" class="form-control mb-md-0 mb-5"
                                                       placeholder="@lang('user.last_name')" name="last_name" required>
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
                                        <input type="text" class="form-control" placeholder="@lang('user.phone')" name="phone">
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
                                                @lang('user.browse')  <input type="file" class="file-browserinput"
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
                                        <input type="email" class="form-control" placeholder="@lang('user.email')" name="email" required>
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">@lang('user.username')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="@lang('user.username')" name="UserName" required>
                                        @error('UserName') <span class="text-danger">{{ $message }}</span> @enderror
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
                                               name="password" required>
                                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <input type="hidden" name="role_id" value="6">
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-left">
                            <button type="submit" class="btn btn-primary">@lang('button.save')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection
