@extends('layouts.admin_panel.main')
@section('header')
    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>@lang('payment.student_fees')</h2>

            </div>

            <div class="pull-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storeModal">
                    @lang('payment.add_new_fees')
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
                        <th>@lang('payment.student')</th>
                        <th>@lang('payment.parent')</th>
                        <th>@lang('payment.fee')</th>
                        <th>@lang('payment.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach ($fees as $fee)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $fee->student->name.' '.$fee->student->last_name }}</td>
                            <td>{{ $fee->parent->name }}</td>
                            <td>{{ $fee->fee }}</td>
                            <td>
                                <div>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                            id="deleteButton" data-id="{{ $fee->id }}">
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


    {{-- add  modal --}}
    <div class="modal fade" id="storeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">@lang('payment.add_new_fees')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('payment.store-students-fees') }}">
                        @csrf
                        <div class="form-group">
                            <label for="student_id" class="form-label">@lang('payment.students') :</label>
                            <select name="student_ids[]" id="student_id" class="form-control select2 custom-select" required multiple>
                                <option label="@lang('subject.Choose')"></option>
                                @foreach($students as $student)
                                    <option value="{{$student->user_id}}">{{$student->details->name.' '.$student->details->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fee" class="col-form-label">@lang('payment.fee') :</label>
                            <input type="number" class="form-control" id="fee" name="fee" required>
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

    {{-- end add  modal --}}

    <script>
        $(document).ready(function () {
            $("#student_id").select2();
        });
    </script>

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
                <form action="{{ route('payment.delete-student-fee') }}" method="POST">
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
