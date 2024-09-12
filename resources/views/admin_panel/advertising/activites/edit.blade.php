@extends('layouts.admin_panel.main')
@section('header')
<h4 class="page-title">{{ $activity->name }}  <span class="font-weight-normal text-muted ml-2">@lang('socialMedia.activity')</span></h4>
@endsection

@section('content')

<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST" action="{{ route('advertising.activites.update') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">@lang('socialMedia.name') :</label>
                            <input type="text" class="form-control" id="recipient-name" name="name"
                            value="{{ $activity->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-form-label">@lang('socialMedia.image') :</label>
                            <input type="file" class="form-control dropify" id="image" name="image" data-height="180"
                                data-default-file="{{ asset($activity->image)  }}">
                        </div>
                        <div class="form-group">
                            <div class="form-group ">
                                <label class="form-label">@lang('socialMedia.rate') :</label>
                                <select class="form-control select2 custom-select" name="rate"
                                    data-placeholder="@lang('button.choose_one')" required>
                                    <option label="Choose one">
                                    </option>
                                    <option value="1" @if($activity->rate == "1") selected @endif>1</option>
                                    <option value="2" @if($activity->rate == "2") selected @endif>2</option>
                                    <option value="3" @if($activity->rate == "3") selected @endif>3</option>
                                    <option value="4" @if($activity->rate == "4") selected @endif>4</option>
                                    <option value="4.5" @if($activity->rate == "4.5") selected @endif>4.5</option>
                                    <option value="5" @if($activity->rate == "5") selected @endif>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">@lang('socialMedia.description') :</label>
                            <textarea class="form-control" id="message-text" rows="4" name="description"
                                required>{{ $activity->description }}</textarea>
                        </div>
                        <input name="id" type="hidden" value=" {{ $activity->id }}">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection
