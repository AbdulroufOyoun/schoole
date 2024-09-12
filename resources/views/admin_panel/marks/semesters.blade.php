@extends('layouts.admin_panel.main')
@section('header')
    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>@lang('term.semesters')</h2>

            </div>

            <div class="pull-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storeModal">
                    @lang('term.add_new_semester')
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
                        <th>@lang('term.semester')</th>
                        <th>@lang('plans.end_at')</th>
                        <th>@lang('plans.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach ($semesters as $semester)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $semester->name }}</td>
                            <td>{{ $semester->end_at }}</td>
                            <td>
                                <div>
                                    <button class="btn btn-blue" data-toggle="modal" data-target="#updateModal"
                                            id="updateButton" data-id="{{ $semester->id }}"
                                            data-name="{{ $semester->name }}"
                                            data-end_at="{{ $semester->end_at }}"
                                            title="@lang('button.update')">
                                        <i class="fa fa-edit"></i>
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
                    <h4 class="modal-title" id="exampleModalLabel">@lang('term.update_semester')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('semesters.update-semester') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">@lang('term.semester_name'):</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="end_at" class="col-form-label">@lang('plans.end_at'):</label>
                            <input type="date" class="form-control" id="end_at" name="end_at" required>
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
            var start_at = button.data('name')
            var end_at = button.data('end_at')
            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #name').val(start_at)
            modal.find('.modal-body #end_at').val(end_at)
        })
    </script>

    {{--   end update modal--}}

    {{-- add modal --}}
    <div class="modal fade" id="storeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">@lang('term.add_new_semester')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5><span class="text-danger">@lang('plans.note')</span> @lang('term.add_semester_description')</h5>
                    <form method="POST" action="{{ route('semesters.store-semester') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">@lang('term.semester_name'):</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="end_at" class="col-form-label">@lang('plans.end_at'):</label>
                            <input type="date" class="form-control" id="end_at" name="end_at" required>
                        </div>
                        <hr>
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
    {{-- end add modal --}}

@endsection
