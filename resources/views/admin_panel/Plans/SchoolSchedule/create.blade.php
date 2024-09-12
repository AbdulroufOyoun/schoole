@extends('layouts.admin_panel.main')
@section('header')

    <h4 class="page-title"> @lang('plans.createSectionSchedule') </h4>
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            <button class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" action="{{ route('plans.setLessonOfDay') }}">
                            @csrf
                            <div class="form-group">
                                <div class="form-group ">
                                    <label class="form-label">@lang('subject.classroom')</label>
                                    <select class="form-control select2 custom-select" name="classroom_id"
                                            data-placeholder="@lang('subject.Choose')" id="classroom" required>
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
                                    <label class="form-label">@lang('subject.section')</label>
                                    <select class="form-control select2 custom-select"  name="section_id"
                                            data-placeholder="@lang('subject.Choose')" id="section" required>
                                        <option label="@lang('subject.Choose')"></option>
                                    </select>
                                    @error('section_id')
                                    <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                        {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label class="form-label">@lang('plans.selectDay')</label>
                                    <select class="form-control select2 custom-select" name="day"
                                            data-placeholder="@lang('plans.selectDay')" id="day" required>
                                        <option label="@lang('subject.Choose')"></option>
                                        @foreach($days as $day)
                                            <option value="{{$day}}"> {{$day}}</option>
                                        @endforeach
                                    </select>
                                    @error('day')
                                    <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                        {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">@lang('button.continue')</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function () {
            $("#section").select2();
            $('#classroom').on('change', function () {

                $("#section").empty();
                let url = '{{ route('subject.filter_section',':id') }}';
                let country_id = $('#classroom').val();
                url = url.replace(':id', country_id);


                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    success: function (jsonObject) {
                        $('#section').select2({data: jsonObject});
                    }
                });
            });
        });

    </script>

@endsection
