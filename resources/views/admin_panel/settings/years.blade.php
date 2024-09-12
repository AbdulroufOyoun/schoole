@extends('layouts.admin_panel.main')
@section('header')
    @lang('years.school_years_managment')
@endsection
@section('content')

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('success') }}
        </div>
    @endif
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
        <div class="card-header border-bottom-0">
            <h3 class="card-title">@lang('years.add')</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('settings.year.create') }}">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name" class="col-form-label">@lang('years.year')</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="end_date" class="col-form-label">@lang('years.end_date')</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">@lang('button.save')</button>
                </div>
            </form>
        </div>
    </div>


    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title">@lang('years.years')</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped card-table table-vcenter text-nowrap mb-0"
                       style="text-align: center">
                    <thead>
                    <tr>
                        <th>*</th>
                        <th>@lang('years.year')</th>
                        <th>@lang('years.end_date')</th>
                        <th>@lang('years.activated')</th>
                        <th>@lang('years.modify')</th>

                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach ($years as $year)
                        <tr>
                            <th scope="row">{{ $i++; }}</th>
                            <td>{{ $year->name }}</td>
                            <td>{{ $year->end_date }}</td>
                            <td>
                                @if ( $year->activated == true )
                                    <i class="fa fa-check-circle text-success"></i>
                                @endif
                            </td>

                            <td>
                                <div style="margin-right: 0">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#updateModal"
                                            id="updateButton" data-id="{{ $year->id }}"
                                            data-name="{{ $year->name }}" data-end_date="{{ $year->end_date }}">
                                        @lang('button.update')</button>
                                    <a class="btn btn-success"
                                       href="{{ route('settings.year.activation_message',$year->id) }}">
                                        @lang('button.activation')</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- update modal --}}
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('years.update')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('settings.year.update') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">@lang('classroom.name'):</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date" class="col-form-label">@lang('years.end_date'):</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                        <input type="hidden" class="form-control" id="id" name="id">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light"
                                    data-dismiss="modal">@lang('button.close')</button>
                            <button type="submit" class="btn btn-primary">@lang('button.update')</button>
                        </div>
                    </form>
                </div>

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
        $('#updateModal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var end_date = button.data('end_date')

            var modal = $(this)
            modal.find('.modal-body #name').val(name)
            modal.find('.modal-body #end_date').val(end_date)
            modal.find('.modal-body #id').val(id)


        })
    </script>
@endsection
