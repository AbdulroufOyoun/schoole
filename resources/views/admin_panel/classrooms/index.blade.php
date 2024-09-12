@extends('layouts.admin_panel.main')
@section('header')
<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2> @lang('classroom.classes_mangament')</h2>

        </div>

        <div class="pull-right">
            <button type="button" class="btn btn-primary" data-toggle="modal"
                data-target="#storeModal">@lang('classroom.add_class')</button>
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
            <h3 class="card-title">@lang('classroom.our_calsses')</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped card-table table-vcenter text-nowrap mb-0" style="text-align: center">
                    <thead>
                        <tr>
                            <th>*</th>
                            <th>@lang('classroom.name')</th>
                            <th>@lang('classroom.number_of_section')</th>
                            <th>@lang('classroom.number_of_student')</th>
                            <th>@lang('classroom.modify')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($classrooms as $classroom)
                        <tr>
                            <th scope="row">{{ $i++; }}</th>
                            <td>{{ $classroom->name }}</td>
                            <td>{{ $classroom->sectionCount() }}</td>
                            <td>{{ $classroom->studentCount() }}</td>
                            <td>
                                <div style="width: 12ch">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#updateModal"
                                        id="updateButton" data-id="{{ $classroom->id }}"
                                        data-name="{{ $classroom->name }}">
                                        @lang('button.update')</button>
                                    <a href="{{ route('classrooms.section.index',$classroom->id) }}"
                                        class="btn btn-light">@lang('button.sections')</a>
                                    @if ($classroom->sectionCount() == 0)
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                        id="deleteButton" data-id="{{ $classroom->id }}">
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


    {{-- add modal --}}
    <div class="modal fade" id="storeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('classroom.add_class')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('classrooms.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">@lang('classroom.name')</label>
                            <input type="text" class="form-control" id="recipient-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="section_number"
                                class="col-form-label">@lang('classroom.number_of_section'):</label>
                            <input type="number" class="form-control" id="section_number" name="section_number"
                                required>
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
                    <form method="POST" action="{{ route('classrooms.update') }}">
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
                            <label for="section_number"
                                class="col-form-label">@lang('classroom.select_classroom'):</label>
                            <div class="form-group">
                                <div class="form-group ">
                                    <select class="form-control select2 custom-select" name="classroom_id"
                                        data-placeholder="@lang('button.choose_one')" required>
                                        <option label="Choose one"></option>
                                        @foreach ($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                        @endforeach
                                    </select>
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
                <form action="{{ route('classrooms.delete') }}" method="POST">
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
