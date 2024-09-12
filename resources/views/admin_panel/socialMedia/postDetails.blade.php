@extends('layouts.admin_panel.main')
@section('header')
    @lang('socialMedia.details')
@endsection
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="fname">@lang('socialMedia.userName')</label>
                </div>
                <div class="form-group col-md-9">
                    <input type="text" class="form-control" id="fname" value="{{ $post->user->name.' '.$post->user->last_name }}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="fname">@lang('socialMedia.userPhone')</label>
                </div>
                <div class="form-group col-md-9">
                    <input type="text" class="form-control" id="fname" value="{{ $post->user->phone }}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="fname">@lang('socialMedia.userEmail')</label>
                </div>
                <div class="form-group col-md-9">
                    <input type="text" class="form-control" id="fname" value="{{ $post->user->email }}" disabled>
                </div>
            </div>
            <br>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="fname">@lang('socialMedia.date')</label>
                </div>
                <div class="form-group col-md-9">
                    <input type="text" class="form-control" id="fname" value="{{ $post->created_at }}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="fname">@lang('socialMedia.title')</label>
                </div>
                <div class="form-group col-md-9">
                    <input type="text" class="form-control" id="fname" value="{{ $post->title }}" disabled>
                </div>
            </div>

            @if ($post->text)
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="message">@lang('socialMedia.text')</label>
                    </div>
                    <div class="form-group col-md-9">
                        <textarea class="form-control" id="message" rows="5" disabled>{{ $post->text }}</textarea>
                    </div>
                </div>
            @endif

            @if (isset($post->attachments[0]))
                <div class="form-group col-md-3">
                    <h3>@lang('socialMedia.images')</h3>
                </div>
                <div class="form-row">
                    @foreach ($post->attachments as $image)
                        <div class="form-group col-md-3">
                            <img src="{{ $image->image }}">
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>

@endsection
