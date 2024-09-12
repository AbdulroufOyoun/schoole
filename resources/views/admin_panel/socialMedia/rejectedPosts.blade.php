@extends('layouts.admin_panel.main')
@section('header')
@lang('socialMedia.tableTitle')
@endsection

@section('content')
<div>
    @if (session('success'))
    <div class="alert alert-success" role="alert"><button class="close" data-dismiss="alert"
            aria-hidden="true">×</button> {{ session('success') }}</div>
    @endif
</div>

<div class="card">
    <div class="card-body ">
        <div class="table-responsive">
            <table id="details-datatable" class="table table-striped card-table table-vcenter text-nowrap mb-0 table-style">
                <thead>
                    <tr>
                        <th>*</th>
                        <th>@lang('socialMedia.userName')</th>
                        <th>@lang('socialMedia.date')</th>
                        <th>@lang('socialMedia.rejected_by')</th>
                        <th>@lang('socialMedia.rejected_reason')</th>
                        <th>@lang('socialMedia.title')</th>
                        <th>@lang('socialMedia.hasText')</th>
                        <th>@lang('socialMedia.hasImages')</th>
                        <th>@lang('socialMedia.modify')</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1; @endphp
                    @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $post->user->name }} {{ $post->user->last_name }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->confirmedBy->name }}</td>
                        <td><textarea disabled>{{ $post->reason_reject }}</textarea></td>
                        <td>{{ $post->title }}</td>
                        <td>
                            @if ($post->text)
                            <i class="fa fa-check-circle-o text-success" data-toggle="tooltip"></i>
                            @endif
                        </td>
                        <td>
                            @if (isset($post->attachments[0]))
                            <i class="fa fa-check-circle-o text-success" data-toggle="tooltip"></i>
                            @endif
                        </td>
                        <td>
                            <div>
                                <a href="{{ route('posts.getPostDetails',$post->id) }}" class="btn btn-primary">@lang('button.details')</a>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                    id="deleteButton" data-id="{{ $post->id }}">
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
            <form action="{{ route('posts.delete') }}" method="POST">
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
