@extends('layouts.admin_panel.main')
@section('header')
    @if($type === 1)  @lang('socialMedia.academics') @else @lang('socialMedia.admins') @endif
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
    <div>
        @error('replied')
        <div class="alert alert-danger" role="alert">
            <button class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="card">
        <div class="card-body ">
            <div class="table-responsive">
                <table id=""
                       class="table table-striped card-table table-vcenter text-nowrap mb-0 table-style">
                    <thead>
                    <tr>
                        <th>*</th>
                        <th>@lang('socialMedia.from')</th>
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
                            <td>{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</td>
                            <td>
                                <textarea rows="4" cols="25" disabled>{{ $message->subject }}</textarea>
                            </td>
                            <td>
                                <textarea rows="4" cols="30" disabled>{{ $message->message }}</textarea>
                            </td>
                            <td>
                                <div>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#sendMessageModal"
                                            data-reply_to_message="{{ $message->id }}"
                                            data-name="{{ $message->sender->name }}">
                                        <i class="fa fa-comment-o" title="@lang('button.delete')"></i>
                                    </button>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                            id="deleteButton" data-id="{{ $message->id }}">
                                        <i class="fa fa-trash" title="@lang('button.delete')"></i></button>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $messages->links() }}
            </div><!-- bd -->
        </div><!-- bd -->
    </div><!-- bd -->

    {{-- send message modal --}}
    <div class="modal fade" id="sendMessageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('socialMedia.send_message')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('messages.reply-message') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">@lang('socialMedia.to'):</label>
                            <input type="text" class="form-control" id="name" name="name" disabled>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="col-form-label">@lang('socialMedia.subject'):</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message" class="col-form-label">@lang('socialMedia.message'):</label>
                            <textarea class="form-control" id="message" rows="7" name="message" required></textarea>
                        </div>
                        <input type="hidden" id="reply_to_message" name="reply_to_message">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light"
                                    data-dismiss="modal">@lang('button.close')</button>
                            <button type="submit" class="btn btn-primary">@lang('button.send')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#sendMessageModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var reply_to_message = button.data('reply_to_message')
            var name = button.data('name')
            var modal = $(this)
            modal.find('.modal-body #name').val(name)
            modal.find('.modal-body #reply_to_message').val(reply_to_message)

        })
    </script>

    {{-- end send message modal --}}


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
