@extends('layouts.admin_panel.main')
@section('header')
    @lang('term.students_marks')
    <span class="pl-3" style="opacity: 50%">
            {{ $subject_mark->subject->name }} | {{ $subject_mark->classroom->name }} | {{ $subject_mark->section->name }}
    </span>
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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-body ">
            <div class="table-responsive">
                <table id="details-datatable"
                       class="table table-striped card-table table-vcenter text-nowrap mb-0 table-style">
                    <thead>
                    <tr>
                        <th>*</th>
                        <th>@lang('term.student')</th>
                        <th>@lang('term.classwork')</th>
                        <th>@lang('term.homework')</th>
                        <th>@lang('term.exam')</th>
                        <th>@lang('term.evaluation')</th>
                        <th>@lang('term.total_mark')</th>
                        <th>@lang('term.percentage')</th>
                        <th>@lang('term.grade')</th>
                        <th>@lang('term.gpa')</th>
                        <th>@lang('term.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach ($subject_mark->marks as $mark)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $mark->user->name.' '.$mark->user->last_name }}</td>
                            <td>{{ $mark->classwork }}</td>
                            <td>{{ $mark->homework }}</td>
                            <td>{{ $mark->exam }}</td>
                            <td><textarea disabled>{{ $mark->evaluation }}</textarea></td>
                            <td>{{ $mark->total_mark }}</td>
                            <td>{{ $mark->percentage()}}%</td>
                            <td>{{ $mark->grade() }}</td>
                            <td>{{ $mark->GPA() }}</td>
                            <td>
                                <div>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#updateModal"
                                            data-id="{{ $mark->id }}"
                                            data-student="{{ $mark->user->name }}"
                                            data-classwork="{{ $mark->classwork }}"
                                            data-homework="{{ $mark->homework }}"
                                            data-exam="{{ $mark->exam }}"
                                            data-evaluation="{{ $mark->evaluation }}"
                                            title="@lang('button.update')">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!--update  Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">@lang('term.update_student_marks')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('marks.update-student-marks') }}">
                        @csrf
                        <div class="form-group">
                            <label for="student" class="col-form-label">@lang('term.student'):</label>
                            <input type="text" class="form-control" id="student" disabled>
                        </div>
                        <div class="form-group">
                            <label for="classwork" class="col-form-label">@lang('plans.classwork'):</label>
                            <input type="number" class="form-control" id="classwork" name="classwork" required>
                        </div>
                        <div class="form-group">
                            <label for="homework" class="col-form-label">@lang('term.homework'):</label>
                            <input type="number" class="form-control" id="homework" name="homework" required>
                        </div>
                        <div class="form-group">
                            <label for="exam" class="col-form-label">@lang('plans.exam'):</label>
                            <input type="number" class="form-control" id="exam" name="exam" required>
                        </div>
                        <div class="form-group">
                            <label for="evaluation" class="col-form-label">@lang('term.evaluation'):</label>
                            <textarea class="form-control" id="evaluation" name="evaluation" rows="4" required></textarea>
                        </div>
                        <hr>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light"
                                    data-dismiss="modal">@lang('button.close')</button>
                            <button type="submit" class="btn btn-primary">@lang('button.update')</button>
                        </div>
                        <input type="hidden" id="id" name="id">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        $('#updateModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var student = button.data('student')
            var classwork = button.data('classwork')
            var homework = button.data('homework')
            var exam = button.data('exam')
            var evaluation = button.data('evaluation')
            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #student').val(student)
            modal.find('.modal-body #classwork').val(classwork)
            modal.find('.modal-body #homework').val(homework)
            modal.find('.modal-body #exam').val(exam)
            modal.find('.modal-body #evaluation').val(evaluation)
        })
    </script>

    {{--   end update modal--}}

@endsection
