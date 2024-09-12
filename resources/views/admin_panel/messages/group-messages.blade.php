@extends('layouts.admin_panel.main')
@section('header')
    @lang('socialMedia.group_messages')
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

    <div class="card">
        <div class="card-body ">
            <div class="table-responsive">
                <table id="details-datatable"
                       class="table table-striped card-table table-vcenter text-nowrap mb-0 table-style">
                    <thead>
                    <tr>
                        <th>*</th>
                        <th>@lang('socialMedia.teacher')</th>
                        <th>@lang('socialMedia.classroom')</th>
                        <th>@lang('socialMedia.section')</th>
                        <th>@lang('socialMedia.date')</th>
                        <th>@lang('socialMedia.subject')</th>
                        <th>@lang('socialMedia.message')</th>
                        <th>@lang('socialMedia.modify')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach ($messages as $message)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $message->sender->name.' '.$message->sender->last_name }}</td>
                            <td>{{ $message->section->classroom->name }}</td>
                            <td>{{ $message->section->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</td>
                            <td>
                                <textarea rows="4" cols="20" disabled>{{ $message->subject }}</textarea>
                            </td>
                            <td>
                                <textarea rows="4" cols="25" disabled>{{ $message->message }}</textarea>
                            </td>
                            <td>
                                <div>
                                    <a href="{{ route('messages.accept-group-message',$message->id) }}"
                                       class="btn btn-success">
                                        <i class="fa fa-check" title="@lang('button.delete')"></i>
                                    </a>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                            id="deleteButton" data-id="{{ $message->id }}">
                                        <i class="fa fa-trash" title="@lang('button.delete')"></i></button>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- bd -->
        </div><!-- bd -->
    </div><!-- bd -->


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
                <form action="{{ route('messages.delete') }}" method="POST">
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
