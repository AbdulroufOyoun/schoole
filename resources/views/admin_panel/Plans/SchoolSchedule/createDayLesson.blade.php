@extends('layouts.admin_panel.main')

@section('header')
    @if(empty($classroomSubjects[0]))
        <h3 class="page-title text-danger">  @lang('plans.mustAssign')</h3>
        @endsection
    @else
        <h4 class="page-title"> @lang('plans.createDaySchedule', ['day' => $day, 'classroom' => $classroomSubjects[0]->classroom->name, 'section' =>$classroomSubjects[0]->section->name ]) </h4>
        @endsection


        @section('content')

            <div class="row">
                <div class="col-xl-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form method="POST" action="{{ route('plans.storeLessonsOfDay') }}">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-group ">
                                            <label class="form-label">@lang('plans.selectedDay')</label>
                                            <input class="form-control" type="text" name="day_id" value="{{$day}}"
                                                   disabled>
                                            <input class="form-control" type="hidden" name="day" value="{{$day}}">
                                            <input class="form-control" type="hidden" name="section_id"
                                                   value="{{$classroomSubjects[0]->section->id}}">
                                            <input class="form-control" type="hidden" name="classroom_id"
                                                   value="{{$classroomSubjects[0]->classroom->id}}">

                                            @error('day')
                                            <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                                 role="alert">
                                                {{ $message }}</div>
                                            @enderror
                                        </div>
                                        @for($i=1 ; $i<=7 ; $i++)
                                            <div class="form-group ">
                                                <label
                                                    class="form-label">@lang('plans.selectSubject', ['numberOfLesson' =>$i ])</label>
                                                <select class="form-control select2 custom-select" name="lessons[]"
                                                        data-placeholder="@lang('subject.Choose')" id="subject"
                                                        required>
                                                    <option value="" label="@lang('subject.Choose')"></option>
                                                    @foreach($classroomSubjects as $classroomSubject)
                                                        <option
                                                            value="{{$classroomSubject->id}}"> {{$classroomSubject->subject->name}}
                                                            | @lang('plans.teacher')
                                                            : {{$classroomSubject->teacher->name}} </option>
                                                    @endforeach
                                                </select>
                                                @error('lessons')
                                                <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                                     role="alert">
                                                    {{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endfor

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">@lang('button.save')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        @endsection
    @endif
