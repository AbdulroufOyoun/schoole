@extends('layouts.admin_panel.main')
@section('header')
    @lang('plans.week_plans')
    <div class="pull-right">
        <a class="btn btn-primary" href="{{route('weekly-plans.index')}}">
            @lang('button.back')
        </a>
    </div>
@endsection

@section('content')
    <div>
        @if (session('success'))
            <div class="alert alert-success" role="alert"><button class="close" data-dismiss="alert"
                                                                  aria-hidden="true">×</button> {{ session('success') }}</div>
        @endif
    </div>

    <div class="card">
        <div class="card-body ">
            <div class="table-responsive">
                <table id="details-datatable" class="table table-striped card-table table-vcenter text-nowrap mb-0 table-style">
                    <thead>
                    <tr>
                        <th>*</th>
                        <th>@lang('plans.classroom')</th>
                        <th>@lang('plans.section')</th>
                        <th>@lang('plans.subject')</th>
                        <th>@lang('plans.day')</th>
                        <th>@lang('plans.teacher')</th>
                        <th>@lang('plans.homework')</th>
                        <th>@lang('plans.classwork')</th>
                        <th>@lang('plans.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach ($weeklyPlans as $weeklyPlan)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $weeklyPlan->section->classroom->name }}</td>
                            <td>{{ $weeklyPlan->section->name }}</td>
                            <td>{{ $weeklyPlan->subject->name }}</td>
                            <td>{{ $weeklyPlan->day }}</td>
                            <td>{{ $weeklyPlan->teacher->name }}</td>
                            <td>
                                <textarea rows="2" cols="25" disabled>{{ $weeklyPlan->homework }}</textarea>
                            </td>
                            <td>
                                <textarea rows="2" cols="25" disabled>{{ $weeklyPlan->classwork }}</textarea>
                            </td>
                            <td>
                                <div>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#updateModal"
                                            id="updateButton" data-id="{{ $weeklyPlan->id }}" data-homework="{{ $weeklyPlan->homework }}" data-classwork="{{ $weeklyPlan->classwork }}">
                                        <i class="fa fa-edit" title="@lang('button.update')"></i>
                                    </button>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                            id="deleteButton" data-id="{{ $weeklyPlan->id }}">
                                        <i class="fa fa-trash" title="@lang('button.delete')"></i>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- bd -->
        </div><!-- bd -->
    </div><!-- bd -->

    <!--update  Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-primary" id="exampleModalLabel">@lang('plans.update_plan')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('weekly-plans.update-plan') }}">
                        @csrf
                        <div class="form-group">
                            <label for="homework" class="col-form-label">@lang('plans.homework'):</label>
                            <textarea rows="5" cols="40" id="homework" name="homework" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="classwork" class="col-form-label">@lang('plans.classwork'):</label>
                            <textarea rows="5" cols="40" id="classwork" name="classwork" class="form-control" required></textarea>
                        </div>
                        <input type="hidden" id="id" name="id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">@lang('button.close')</button>
                            <button type="submit" class="btn btn-primary">@lang('button.update')</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        $('#updateModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var homework = button.data('homework')
            var classwork = button.data('classwork')
            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #homework').val(homework)
            modal.find('.modal-body #classwork').val(classwork)
        })
    </script>
    {{--   end update post modal--}}

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
                <form action="{{ route('weekly-plans.delete-plan') }}" method="POST">
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

@endsection
