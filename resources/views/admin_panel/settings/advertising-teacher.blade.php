@extends('layouts.admin_panel.main')
@section('header')
    @lang('schools.advertising_teachers')
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
            <h3 class="card-title">@lang('schools.add_teacher')</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('settings.store-advertising-teacher') }}">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="id" class="col-form-label">@lang('schools.teacher_name')</label>
                            <select class="form-control select2 custom-select" name="id" id="id"
                                    data-placeholder="@lang('button.choose_one')" required>
                                <option label="Choose one"></option>
                                @foreach ($teachers as $tt)
                                    <option value="{{ $tt->id }}">{{ $tt->name }} {{ $tt->last_name }}
                                        | {{ $tt->school->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mt-4">@lang('button.add')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title">@lang('schools.teachers')</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped card-table table-vcenter text-nowrap mb-0"
                       style="text-align: center">
                    <thead>
                    <tr>
                        <th>*</th>
                        <th>@lang('schools.teacher_name')</th>
                        <th>@lang('schools.teacher_school')</th>
                        <th>@lang('button.action')</th>

                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach ($advertisingTeachers as $advertisingTeacher)
                        <tr>
                            <th scope="row">{{ $i++; }}</th>
                            <td>{{ $advertisingTeacher->teacher->name }}</td>
                            <td>{{ $advertisingTeacher->teacher->school->name }}</td>
                            <td>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                        data-id="{{ $advertisingTeacher->id }}"
                                        title="@lang('button.delete')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
                <form action="{{ route('settings.delete-advertising-teacher') }}" method="POST">
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
