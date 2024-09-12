@extends('layouts.admin_panel.main')
@section('header')
    @lang('plans.study_plans')
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
    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="mb-0 card-title">@lang('plans.allow_title')</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-12">
                    <form action="{{route('plans.update-lesson-plan-setting')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="custom-switch">
                                <span class="custom-switch-description mr-2">@lang('plans.allow')</span>
                                    <input type="checkbox" name="enable" class="custom-switch-input" @if($settings && $settings->enable == true) checked="" @endif >
                                <span class="custom-switch-indicator custom-switch-indicator-lg"></span>
                            </label>
                            <button type="submit" class="btn btn-primary pull-right">@lang('button.update')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body ">
            <div class="table-responsive">
                <table id="details-datatable"
                       class="table table-striped card-table table-vcenter text-nowrap mb-0 table-style">
                    <thead>
                    <tr>
                        <th>*</th>
                        <th>@lang('plans.classroom')</th>
                        <th>@lang('plans.teacher')</th>
                        <th>@lang('plans.subject')</th>
                        <th>@lang('plans.date')</th>
                        <th>@lang('plans.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach ($lessonPlans as $lessonPlan)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $lessonPlan->classroom->name }}</td>
                            <td>{{ $lessonPlan->teacher->name.' '.$lessonPlan->teacher->last_name }}</td>
                            <td>{{ $lessonPlan->subject->name }}</td>
                            <td>{{ date('Y-m-d',strtotime($lessonPlan->created_at)) }}</td>
                            <td>
                                <div>
                                    <a href="{{ route('plans.browsePdf',$lessonPlan->id) }}"
                                       class="btn btn-primary">@lang('plans.pdf')</a>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                            id="deleteButton" data-id="{{ $lessonPlan->id }}">
                                        @lang('button.delete')</button>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- bd -->
        </div><!-- bd -->
    </div>

    <!--delete  Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('classroom.confirm_deletion')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @lang('classroom.delete_message')
                </div>
                <form action="{{ route('plans.delete') }}" method="POST">
                    @csrf
                    <div class="modal-footer">
                        <input type="hidden" id="id" name="id">
                        <button type="button" class="btn btn-light" data-dismiss="modal">@lang('button.close')</button>
                        <button type="submit" class="btn btn-danger">@lang('button.delete')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-footer input').val(id)

        })
    </script>
    <script>
        function submitForm() {
            document.getElementById('myForm').submit();
        }
    </script>

@endsection

