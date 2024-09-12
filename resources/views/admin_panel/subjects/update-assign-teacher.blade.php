@extends('layouts.admin_panel.main')
@section('header')

    <h4 class="page-title"> @lang('subject.update_assign_teacher') </h4>
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
                        <form method="POST" action="{{ route('subject.update_assign_teacher') }}">
                            @csrf
                            <div class="form-group">
                                <div class="form-group ">
                                    <label for="teacher_id" class="form-label">@lang('subject.teacher')</label>
                                    <select class="form-control select2 custom-select" id="teacher_id" name="teacher_id"
                                            data-placeholder="@lang('subject.Choose')" required>
                                        <option label="@lang('subject.Choose')"></option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}"
                                                    @if($classroomSubject->teacher_id == $teacher->id) selected @endif>{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('teacher_id')
                                    <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                        {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label for="subject_id" class="form-label">@lang('subject.subject')</label>
                                    <select class="form-control select2 custom-select" id="subject_id" name="subject_id"
                                            data-placeholder="@lang('subject.Choose')" required>
                                        <option label="@lang('subject.Choose')"></option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}"
                                                    @if($classroomSubject->subject_id == $subject->id) selected @endif> {{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                    <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                        {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label for="classroom" class="form-label">@lang('subject.classroom')</label>
                                    <select class="form-control select2 custom-select" name="classroom_id"
                                            data-placeholder="@lang('subject.Choose')" id="classroom" required>
                                        <option label="@lang('subject.Choose')"></option>
                                        @foreach ($classrooms as $classroom)
                                            <option value="{{ $classroom->id }}"
                                                    @if($classroomSubject->classroom_id == $classroom->id) selected @endif>{{ $classroom->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('classroom_id')
                                    <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                        {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label for="section" class="form-label">@lang('subject.section')</label>
                                    <select class="form-control select2 custom-select" name="section_id"
                                            data-placeholder="@lang('subject.Choose')" id="section" required>
                                        <option label="@lang('subject.Choose')"></option>
                                        @foreach($sections as $section)
                                            <option value="{{ $section->id }}"
                                                    @if($classroomSubject->section_id == $section->id) selected @endif>{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('section_id')
                                    <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                        {{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" name="id" value="{{$classroomSubject->id}}">
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">@lang('button.update')</button>
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
