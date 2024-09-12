@extends('layouts.admin_panel.main')
@section('header')
    @if(empty($schedule[0]))
        <h4 class="page-title text-danger"> @lang('plans.emptySchedule') </h4>
    @else
        <h4 class="page-title"> @lang('plans.schedule', ['classroom' => $schedule[0]->section->classroom->name, 'section' =>$schedule[0]->section->name ]) </h4>
    @endif
@endsection
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>@lang('plans.day')</th>
                        @for($i=1 ; $i<=7 ; $i++ )
                            <th>@lang('plans.lesson')  {{$i}}</th>
                        @endfor
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($schedule as $item)
                        <tr>
                            <td>{{ $item->day }}</td>
                            @for($i=1 ; $i<=7 ; $i++ )
                                <td>{{ $item->classroomSubject($i)->first()->subject->name }} | @lang('plans.teacher') : {{ $item->classroomSubject($i)->first()->teacher->name }}</td>
                            @endfor
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
