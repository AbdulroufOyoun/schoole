@extends('layouts.admin_panel.main')
@section('header')
    @lang('term.marks_configuration')
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
                        <th>@lang('term.classroom')</th>
                        <th>@lang('term.subject')</th>
                        <th>@lang('term.full_mark')</th>
                        <th>@lang('term.passing_mark')</th>
                        <th>@lang('term.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach ($subjects_marks as $subjects_mark)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $subjects_mark->classroom->name }}</td>
                            <td>{{ $subjects_mark->subject->name }}</td>
                            <td>{{ $subjects_mark->full_mark }}</td>
                            <td>{{ $subjects_mark->passing_mark }}</td>
                            <td>
                                <div>
                                    <a class="btn btn-primary" href="{{ route('marks.config-subjects-marks') }}"
                                       title="@lang('button.edit')">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
