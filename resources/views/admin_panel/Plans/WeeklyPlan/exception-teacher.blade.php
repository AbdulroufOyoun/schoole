@extends('layouts.admin_panel.main')
@section('header')
    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>@lang('plans.weeks')</h2>

            </div>

            <div class="pull-right pl-3">
                <a class="btn btn-dark" href="{{route('weekly-plans.index')}}">
                    @lang('button.back')
                </a>
            </div>

            <div class="pull-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storeModal">
                    @lang('plans.new_teacher_exception')
                </button>
            </div>

        </div>

    </div>

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
                        <th>@lang('plans.teacher')</th>
                        <th>@lang('plans.teacher_number')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach ($exceptionTeachers as $exceptionTeacher)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $exceptionTeacher->teacher->name }}</td>
                            <td>{{ $exceptionTeacher->teacher  ->phone }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- bd -->
        </div><!-- bd -->
    </div><!-- bd -->

    {{-- add new exception modal --}}
    <div class="modal fade" id="storeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">@lang('plans.new_teacher_exception')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('weekly-plans.store-exception-teacher') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">@lang('plans.teacher'):</label>
                            <select class="form-control select2 custom-select" name="teacher_id" required>
                                <option label="@lang('plans.teacher_name')"></option>
                                @foreach($teachers as $teacher)
                                    <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light"
                                    data-dismiss="modal">@lang('button.close')</button>
                            <button type="submit" class="btn btn-primary">@lang('button.save')</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    </div>
    {{-- end add exception modal --}}

    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>

@endsection
