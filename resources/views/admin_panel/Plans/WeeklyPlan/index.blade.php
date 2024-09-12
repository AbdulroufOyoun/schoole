@extends('layouts.admin_panel.main')
@section('header')
    <div class="row">

        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>@lang('plans.weeks')</h2>
            </div>
            <div class="pull-right ml-1">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cleanModal">
                    @lang('plans.cleaner')
                </button>
            </div>

            <div class="pull-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storeModal">
                    @lang('plans.add_new_week')
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
                        <th>@lang('plans.start_at')</th>
                        <th>@lang('plans.end_at')</th>
                        <th>@lang('plans.activated')</th>
                        <th>@lang('plans.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach ($weeks as $week)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $week->start_at }}</td>
                            <td>{{ $week->end_at }}</td>
                            <td>
                                @if($week->activated)
                                    <i class="fa fa-check text-success"></i>
                                @else
                                    <i class="fa fa-times-circle-o text-danger"></i>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <a href="{{ route('weekly-plans.exception-teacher',$week->id) }}"
                                       class="btn btn-primary"
                                       title="@lang('plans.teacherException')">
                                        <i class="fa fa-user-plus"></i>
                                    </a>

                                    <button class="btn btn-blue" data-toggle="modal" data-target="#updateModal"
                                            id="deletePostButton" data-id="{{ $week->id }}"
                                            data-start_at="{{ $week->start_at }}"
                                            data-end_at="{{ $week->end_at }}"
                                            data-start_upload_plans="{{ $week->start_upload_plans }}"
                                            data-end_upload_plans="{{ $week->end_upload_plans }}"
                                            title="@lang('button.update')">
                                        <i class="fa fa-edit" ></i>
                                    </button>

                                    <a href="{{ route('weekly-plans.browse-plans',$week->id) }}"
                                       class="btn btn-info"
                                       title="@lang('plans.browsePlans')">
                                        <i class="fa fa-book"></i>
                                    </a>

                                    <a href="{{ route('weekly-plans.activation-week',$week->id) }}"
                                       class="btn btn-success" onclick="return confirm('@lang('alert.active_week')')"
                                       title="@lang('button.activation')">
                                        <i class="fa fa-check-circle-o" ></i>
                                    </a>

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
                    <h4 class="modal-title" id="exampleModalLabel">@lang('plans.update_week')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('weekly-plans.update-week') }}">
                        @csrf
                        <div class="form-group">
                            <label for="start_at" class="col-form-label">@lang('plans.start_at'):</label>
                            <input type="datetime-local" class="form-control" id="start_at" name="start_at" required>
                        </div>
                        <div class="form-group">
                            <label for="end_at" class="col-form-label">@lang('plans.end_at'):</label>
                            <input type="datetime-local" class="form-control" id="end_at" name="end_at" required>
                        </div>
                        <hr>
                        <h6>@lang('plans.uploadPlansDescription')</h6>
                        <div class="form-group">
                            <label for="start_upload_plans" class="col-form-label">@lang('plans.start_at'):</label>
                            <input type="datetime-local" class="form-control" id="start_upload_plans"
                                   name="start_upload_plans" required>
                        </div>
                        <div class="form-group">
                            <label for="end_upload_plans" class="col-form-label">@lang('plans.end_at'):</label>
                            <input type="datetime-local" class="form-control" id="end_upload_plans"
                                   name="end_upload_plans" required>
                        </div>

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
            var start_at = button.data('start_at')
            var end_at = button.data('end_at')
            var start_upload_plans = button.data('start_upload_plans')
            var end_upload_plans = button.data('end_upload_plans')
            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #start_at').val(start_at)
            modal.find('.modal-body #end_at').val(end_at)
            modal.find('.modal-body #start_upload_plans').val(start_upload_plans)
            modal.find('.modal-body #end_upload_plans').val(end_upload_plans)


        })
    </script>
    {{--   end update post modal--}}
    {{-- add week modal --}}
    <div class="modal fade" id="storeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">@lang('plans.add_new_week')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5><span class="text-danger">@lang('plans.note')</span> @lang('plans.create_description')</h5>
                    <form method="POST" action="{{ route('weekly-plans.store-week') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="start_at" class="col-form-label">@lang('plans.start_at'):</label>
                            <input type="datetime-local" class="form-control" id="start_at" name="start_at" required>
                        </div>
                        <div class="form-group">
                            <label for="end_at" class="col-form-label">@lang('plans.end_at'):</label>
                            <input type="datetime-local" class="form-control" id="end_at" name="end_at" required>
                        </div>
                        <hr>
                        <h6>@lang('plans.uploadPlansDescription')</h6>
                        <div class="form-group">
                            <label for="start_upload_plans" class="col-form-label">@lang('plans.start_at'):</label>
                            <input type="datetime-local" class="form-control" id="start_upload_plans"
                                   name="start_upload_plans" required>
                        </div>
                        <div class="form-group">
                            <label for="end_upload_plans" class="col-form-label">@lang('plans.end_at'):</label>
                            <input type="datetime-local" class="form-control" id="end_upload_plans"
                                   name="end_upload_plans" required>
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
    {{-- end add week modal --}}
    <!--cleaner  Modal -->
    <div class="modal fade" id="cleanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('classroom.Confirm clean')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @lang('classroom.cleaning_message')
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id" name="id">
                    <button type="button" class="btn btn-light" data-dismiss="modal">@lang('button.close')</button>
                    <a href="{{ route('weekly-plans.cleaning') }}"class="btn btn-danger">@lang('button.delete')</a>
                </div>
            </div>
        </div>
    </div>

@endsection
