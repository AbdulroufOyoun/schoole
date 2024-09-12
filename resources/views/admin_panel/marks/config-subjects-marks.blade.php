@extends('layouts.admin_panel.main')
@section('header')
    @lang('term.config_marks')
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <form method="POST" action="{{ route('marks.store-configuration') }}">
                @csrf
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="form-label" for="classrooms">@lang('subject.classroom')</label>
                                    <select class="form-control select2 custom-select" name="classroom_id"
                                            data-placeholder="@lang('subject.Choose')" id="classrooms" required>
                                        <option label="@lang('subject.Choose')"></option>
                                        @foreach ($classrooms as $classroom)
                                            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('classroom_id')
                                    <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                        {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label class="form-label" for="subject">@lang('term.select_subject')</label>
                                    <select class="form-control select2 custom-select" multiple name="subject_ids[]"
                                            data-placeholder="@lang('subject.Choose')" id="subject" required>
                                        <option label="@lang('subject.Choose')"></option>
                                    </select>
                                    @error('subject_ids')
                                    <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                        {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label class="form-label" for="full_mark">@lang('term.full_mark')</label>
                                    <input class="form-control" name="full_mark" id="full_mark" placeholder="@lang('term.like') 100" required>
                                    @error('full_mark')
                                    <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                        {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label class="form-label" for="passing_mark">@lang('term.passing_mark')</label>
                                    <input class="form-control" name="passing_mark" id="passing_mark" placeholder="@lang('term.like') 60" required>
                                    @error('passing_mark')
                                    <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                        {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">@lang('button.save')</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#subject').select2();
            $('#classrooms').on('change', function () {

                $("#subject").empty();
                let url = '{{ route('marks.filter-subject',':id') }}';
                let classroom_id = $('#classrooms').val();
                url = url.replace(':id', classroom_id);
                console.log(url);

                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    success: function (jsonObject) {
                        $('#subject').select2({data: jsonObject});
                    }
                });
            });

        });

    </script>

@endsection
