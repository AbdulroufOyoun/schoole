@extends('layouts.admin_panel.main')
@section('header')
<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2> @lang('classroom.sections_mangament')</h2>

        </div>

        <div class="pull-right">
            <button type="button" class="btn btn-primary" data-toggle="modal"
                data-target="#addSectionModal">@lang('classroom.add_section')</button>
        </div>

    </div>

</div>
@endsection
@section('content')

<div>
    @if (session('success'))
    <div class="alert alert-success" role="alert"><button class="close" data-dismiss="alert"
            aria-hidden="true">×</button> {{ session('success') }}</div>
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
            <h3 class="card-title">{{ $classroom->name }} @lang('classroom.sections')</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped card-table table-vcenter text-nowrap mb-0" style="text-align: center">
                    <thead>
                        <tr>
                            <th>*</th>
                            <th>@lang('classroom.name')</th>
                            <th>@lang('classroom.name_of_classroom')</th>
                            <th>@lang('classroom.number_of_student')</th>
                            <th>@lang('classroom.modify')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($sections as $section)
                        <tr>
                            <th scope="row">{{ $i++; }}</th>
                            <td>{{ $section->name }}</td>
                            <td>{{ $section->classroom->name }}</td>
                            <td>{{ $section->studentCount() }}</td>
                            <td>
                                <div style="width: 5ch">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#updateModal"
                                        id="updateButton" data-id="{{ $section->id }}" data-name="{{ $section->name }}">
                                        @lang('button.update')</button>
                                        @if ($section->allYearstudentCount() == 0)
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                        id="deleteButton" data-id="{{ $section->id }}">
                                        @lang('button.delete')</button>
                                        @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- bd -->
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
                    <form method="POST" action="{{ route('classrooms.section.update') }}">
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

    {{-- add section modal --}}
    <div class="modal fade" id="addSectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('classroom.add_section')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('classrooms.section.add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">@lang('classroom.name'):</label>
                            <input type="text" class="form-control" id="recipient-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <div class="form-group ">
                                    <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
                                </div>
                            </div>
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
                <form action="{{ route('classrooms.section.delete') }}" method="POST">
                    @csrf
                    <div class="modal-footer">
                        <input type="hidden" id="id" name="id">
                        <button type="button" class="btn btn-light"
                            data-dismiss="modal">@lang('button.close')</button>
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
