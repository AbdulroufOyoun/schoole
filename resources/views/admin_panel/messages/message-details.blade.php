@extends('layouts.admin_panel.main')
@section('header')
    @lang('socialMedia.reply_from')
@endsection
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="sender">@lang('socialMedia.from')</label>
                </div>
                <div class="form-group col-md-9">
                    <input type="text" class="form-control" id="sender" value="{{ $message->sender->name.' '.$message->sender->last_name }}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="user">@lang('socialMedia.to')</label>
                </div>
                <div class="form-group col-md-9">
                    <input type="text" class="form-control" id="user" value="{{ $message->user->name.' '.$message->user->last_name }}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="date">@lang('socialMedia.date')</label>
                </div>
                <div class="form-group col-md-9">
                    <input type="text" class="form-control" id="date" value="{{ $message->created_at }}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="accepted_at">@lang('socialMedia.accepted_at')</label>
                </div>
                <div class="form-group col-md-9">
                    <input type="text" class="form-control" id="accepted_at" value="{{ $message->accepted_at }}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="subject">@lang('socialMedia.subject')</label>
                </div>
                <div class="form-group col-md-9">
                    <input type="text" class="form-control" id="subject" value="{{ $message->subject }}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="message">@lang('socialMedia.message')</label>
                </div>
                <div class="form-group col-md-9">
                    <textarea  id="message" rows="6" style="width: 100%" disabled>{{ $message->message }}</textarea>
                </div>
            </div>
            <br>



        </div>
    </div>

@endsection
