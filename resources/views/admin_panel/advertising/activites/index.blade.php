@extends('layouts.admin_panel.main')
@section('header')
<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>@lang('socialMedia.activities')</h2>

        </div>

        <div class="pull-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storeModal">@lang('socialMedia.add_activity')</button>
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
</div>
<style>
    table th {
        width: 25ch;
    }
</style>

<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title">@lang('socialMedia.our_activities')</h3>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped card-table table-vcenter text-nowrap mb-0">
                <thead>
                    <tr>
                        <th>*</th>
                        <th>@lang('socialMedia.name')</th>
                        <th>@lang('socialMedia.rate')</th>
                        <th>@lang('socialMedia.image')</th>
                        <th>@lang('socialMedia.modify')</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1; @endphp
                    @foreach ($activites as $activity)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $activity->name }}</td>
                        <td>{{ $activity->rate }}</td>
                        <td><img src="{{ asset($activity->image) }}" style="max-width: 10ch;"></td>
                        <td>
                            <div>
                                <a href="{{ route('advertising.activites.edit',$activity->id) }}" class="btn btn-info"> @lang('button.update') </a>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                    id="deleteButton" data-id="{{ $activity->id }}">
                                    @lang('button.delete')</button>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- bd -->
    </div><!-- bd -->
</div><!-- bd -->

{{-- add activity modal --}}
<div class="modal fade" id="storeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('socialMedia.add_activity')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('advertising.activites.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">@lang('socialMedia.name') :</label>
                        <input type="text" class="form-control" id="recipient-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-form-label">@lang('socialMedia.image') :</label>
                        <input type="file" class="form-control dropify" id="image" name="image" data-height="120"
                            required>
                    </div>
                    <div class="form-group">
                        <div class="form-group ">
                            <label class="form-label">@lang('socialMedia.rate') :</label>
                            <select class="form-control select2 custom-select" name="rate" data-placeholder="@lang('button.choose_one')"
                                required>
                                <option label="Choose one">
                                </option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="4.5">4.5</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">@lang('socialMedia.description') :</label>
                        <textarea class="form-control" id="message-text" rows="4" name="description"
                            required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">@lang('button.close')</button>
                        <button type="submit" class="btn btn-primary">@lang('button.save')</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- end add activity modal --}}

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
            <form action="{{ route('advertising.activites.delete') }}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">@lang('button.close')</button>
                    <button type="submit" class="btn btn-danger">@lang('button.delete')</button>
                    <input type="hidden" id="id" name="id">
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).on("click", "#deleteButton", function () {
        var id = $(this).data('id');
        $(".modal-footer #id").val(id);
    })
</script>

@endsection
