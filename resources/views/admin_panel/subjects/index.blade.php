@extends('layouts.admin_panel.main')
@section('header')
    @lang('subject.school_subject_managment')
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
            <h3 class="card-title">@lang('subject.add')</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('subject.store') }}">
                @csrf
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">@lang('subject.name')</label>
                    <input type="text" class="form-control" id="recipient-name" name="name" required>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">@lang('button.save')</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title">@lang('subject.subjects')</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped card-table table-vcenter text-nowrap mb-0" style="text-align: center">
                    <thead>
                    <tr>
                        <th>*</th>
                        <th>@lang('subject.name')</th>
                        <th>@lang('subject.modify')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach ($subjects as $subject)
                        <tr>
                            <th scope="row">{{ $i++; }}</th>
                            <td>{{ $subject->name }}</td>

                            <td>
                                <div style="margin-right: 0">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#updateModal"
                                            id="updateButton" data-id="{{ $subject->id }}"
                                            data-name="{{ $subject->name }}">
                                        @lang('button.update')</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">@lang('classroom.update_calss')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('subject.update') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">@lang('classroom.name'):</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <input type="hidden" class="form-control" id="id" name="id">

                        </div>
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
            var modal = $(this)
            modal.find('.modal-body #name').val(name)
            modal.find('.modal-body #id').val(id)

        })
    </script>
@endsection
