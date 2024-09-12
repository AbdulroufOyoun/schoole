@extends('layouts.admin_panel.main')
@section('header')
    @lang('term.subject_marks')
    @if(isset($subjects_marks[0]))
        <span class="pl-3" style="opacity: 50%">
           {{ $subjects_marks[0]->term->semester->name }} | {{ $subjects_marks[0]->term->name }}
        </span>
    @endif
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
                        <th>@lang('term.subject')</th>
                        <th>@lang('term.classroom')</th>
                        <th>@lang('term.section')</th>
                        <th>@lang('term.passing_mark')</th>
                        <th>@lang('term.full_mark')</th>
                        <th>@lang('term.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach ($subjects_marks as $subjects_mark)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $subjects_mark->subject->name }}</td>
                            <td>{{ $subjects_mark->classroom->name }}</td>
                            <td>{{ $subjects_mark->section->name }}</td>
                            <td>{{ $subjects_mark->passing_mark }}</td>
                            <td>{{ $subjects_mark->full_mark }}</td>
                            <td>
                                <div>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                            data-id="{{ $subjects_mark->id }}"
                                            title="@lang('button.delete')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <a href="{{ route('marks.students-marks',$subjects_mark->id) }}"
                                       class="btn btn-primary"
                                       title="@lang('button.details')">
                                        <i class="fa fa-info-circle"></i>
                                    </a>
                                </div>
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
                <form action="{{ route('marks.delete') }}" method="POST">
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
