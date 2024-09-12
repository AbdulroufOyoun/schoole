@extends('layouts.admin_panel.main')
@section('header')

<h4 class="page-title"> @lang('subject.assign_teacher') </h4>
@endsection

@section('content')

@if (session('success'))
<div class="alert alert-success" role="alert"><button class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{ session('success') }}
</div>
@endif
@if (session('error'))
    <div class="alert alert-danger" role="alert"><button class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ session('error') }}
    </div>
@endif

<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST" action="{{ route('subject.assign') }}">
                        @csrf
                        <div class="form-group">
                            <div class="form-group ">
                                <label class="form-label">@lang('subject.teacher')</label>
                                <select class="form-control select2 custom-select" name="teacher_id"
                                    data-placeholder="@lang('subject.Choose')" required>
                                    <option label="@lang('subject.Choose')"></option>
                                    @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }} {{ $teacher->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                    {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label class="form-label">@lang('subject.subject')</label>
                                <select class="form-control select2 custom-select" name="subject_id"
                                    data-placeholder="@lang('subject.Choose')" required>
                                    <option label="@lang('subject.Choose')"></option>
                                    @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                    {{ $message }}</div>
                                @enderror
                            </div>
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
                                <select class="form-control select2 custom-select" multiple name="section_ids[]"
                                    data-placeholder="@lang('subject.Choose')" id="section" required>
                                    <option label="@lang('subject.Choose')"></option>
                                </select>
                                @error('section_ids')
                                <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                    {{ $message }}</div>
                                @enderror
                            </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">@lang('subject.assign')</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script>

$( document ).ready(function() {
    $('#classroom').on('change', function () {

            $("#section").empty();
            let url = '{{ route('subject.filter_section',':id') }}';
            let country_id= $('#classroom').val();
            url = url.replace(':id',country_id);


            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function (jsonObject){
                    $('#section').select2({ data: jsonObject });
                }
            });
        });
});

</script>

@endsection
