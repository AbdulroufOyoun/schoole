@extends('layouts.admin_panel.main')
@section('header')
    {{$student->name .' ' . $student->last_name}}
    <span class="pl-3" style="opacity: 50%">
            {{ $student->classroom->name }}
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
    {{--        semestets table       --}}
    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title">@lang('term.semesters_grade')</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap mb-0 table-style">
                    <thead>
                    <tr>
                        <th>@lang('term.semester')</th>
                        <th>@lang('term.classwork')</th>
                        <th>@lang('term.homework')</th>
                        <th>@lang('term.exam')</th>
                        <th>@lang('term.total_mark')</th>
                        <th>@lang('term.percentage')</th>
                        <th>@lang('term.grade')</th>
                        <th>@lang('term.gpa')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($semesters as $semester)
                        <tr>
                            <td>{{ $semester->name }}</td>
                            <td>{{ $semester->totalClasswork($student->id) }}</td>
                            <td>{{ $semester->totalHomework($student->id) }}</td>
                            <td>{{ $semester->totalExam($student->id) }}</td>
                            <td>{{ $semester->totalMark($student->id) }}</td>
                            <td>{{ $semester->percentage($student->id)}}%</td>
                            <td>{{ $semester->grade($student->id) }}</td>
                            <td>{{ $semester->GPA($student->id) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="8" class="bg-gradient-success"><b> @lang('term.final_grade') </b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{$final_grade['classwork']}}</td>
                        <td>{{$final_grade['homework']}}</td>
                        <td>{{$final_grade['exam']}}</td>
                        <td>{{$final_grade['total_marks']}}</td>
                        <td>{{$final_grade['final_percentage']}}%</td>
                        <td>{{$final_grade['grade']}}</td>
                        <td>{{$final_grade['GPA']}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{--        terms tables       --}}
    @foreach ($semesters as $semester)
        <div class="card">
            <div class="card-header border-bottom-0">
                <h3 class="card-title">{{$semester->name}}</h3>
            </div>
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap mb-0 table-style">
                        <thead>
                        <tr>
                            <th>@lang('term.subject')</th>
                            <th>@lang('term.classwork')</th>
                            <th>@lang('term.homework')</th>
                            <th>@lang('term.exam')</th>
                            <th>@lang('term.evaluation')</th>
                            <th>@lang('term.total_mark')</th>
                            <th>@lang('term.percentage')</th>
                            <th>@lang('term.grade')</th>
                            <th>@lang('term.gpa')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($semester->terms as $term)
                            <tr>
                                <td colspan="9" class="bg-gray-200"><b>{{$term->name}}</b></td>
                            </tr>
                            @foreach ($term->marks($student->id) as $mark)
                                <tr>
                                    <td>{{ $mark->subjectMark->subject->name }}</td>
                                    <td>{{ $mark->classwork }}</td>
                                    <td>{{ $mark->homework }}</td>
                                    <td>{{ $mark->exam }}</td>
                                    <td><textarea disabled>{{ $mark->evaluation }}</textarea></td>
                                    <td>{{ $mark->total_mark }}</td>
                                    <td>{{ $mark->percentage()}}%</td>
                                    <td>{{ $mark->grade() }}</td>
                                    <td>{{ $mark->GPA() }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="9" class="bg-azure-lightest"><b> {{$term->name}} @lang('term.grade') </b></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>{{$term->totalClasswork($student->id)}}</td>
                                <td>{{$term->totalHomework($student->id)}}</td>
                                <td>{{$term->totalexam($student->id)}}</td>
                                <td></td>
                                <td>{{$term->totalMark($student->id)}}</td>
                                <td>{{$term->percentage($student->id)}}%</td>
                                <td>{{$term->grade($student->id)}}</td>
                                <td>{{$term->GPA($student->id)}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
@endsection
