@extends('layouts.admin_panel.main')
@section('header')
    @lang('socialMedia.send_message')
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
    <div class="row">
        <div class="col-xl-6 col-md-12 col-lg-12">
            <form action="{{route('messages.send-message')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title"> @lang('socialMedia.single_message')</h4>
                    </div>
                    <div class="card-body">
                        <div class="leave-types">
                            <div class="form-group">
                                <label class="form-label">@lang('socialMedia.userName')</label>
                                <select name="user_id" class="form-control custom-select select2"
                                        id="daterange-categories" required>
                                    <option>@lang('socialMedia.choose_one')</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name.' '.$user->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="leave-content active" id="single">
                                <div class="form-group">
                                    <label class="form-label">@lang('socialMedia.subject')</label>
                                    <div class="input-group">
                                        <input type="text" name="subject" class="form-control"
                                               placeholder="@lang('socialMedia.subject')" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">@lang('socialMedia.message')</label>
                                <textarea name="message" class="form-control" placeholder="@lang('socialMedia.message')"
                                         rows=6 required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex">
                            <div class="ml-auto">
                                <button type="submit" class="btn btn-primary">@lang('button.send')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-xl-6 col-md-12 col-lg-12">
            <form action="{{route('messages.send-group-message')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title"> @lang('socialMedia.group_message')</h4>
                    </div>
                    <div class="card-body">
                        <div class="leave-types">
                            <div class="form-group">
                                <label class="form-label">@lang('socialMedia.to_group')</label>
                                <select name="type" class="form-control custom-select select2" required>
                                    <option>Choose one</option>
                                    <option value="1">students</option>
                                    <option value="4">parents</option>
                                    <option value="2">teachers</option>
                                    <option value="3">editors</option>
                                </select>
                            </div>
                            <div class="leave-content active" id="single">
                                <div class="form-group">
                                    <label class="form-label">@lang('socialMedia.subject')</label>
                                    <div class="input-group">
                                        <input type="text" name="subject" class="form-control"
                                               placeholder="@lang('socialMedia.subject')" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">@lang('socialMedia.message')</label>
                                <textarea name="message" class="form-control" placeholder="@lang('socialMedia.message')"
                                          rows=6 required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex">
                            <div class="ml-auto">
                                <button type="submit" class="btn btn-primary">@lang('button.send')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('#daterange-categories').select2();
        });
    </script>
@endpush
