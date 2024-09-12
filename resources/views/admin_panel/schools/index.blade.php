@extends('layouts.admin_panel.main')
@section('header')
    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> @lang('schools.schools') </h2>

            </div>

            <div class="pull-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storeModal">@lang('schools.create_new_school')</button>
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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <style>
        table th {
            width: 25ch;
        }
    </style>

    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title">@lang('schools.our_schools')</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped card-table table-vcenter text-nowrap mb-0">
                    <thead>
                    <tr>
                        <th>*</th>
                        <th>@lang('schools.name')</th>
                        <th>@lang('schools.logo')</th>
                        <th>@lang('schools.welcome_screen')</th>
                        <th>@lang('button.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach ($schools as $school)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $school->name }}</td>
                            <td><img src="{{ asset($school->logo) }}" style="max-width: 10ch;"></td>
                            <td>{{ $school->welcome_screen }}</td>
                            <td>
                                <div>
                                    <button data-toggle="modal" data-target="#updateModel"
                                         id="updateButton" class="btn btn-primary"
                                            data-id="{{$school->id}}" title=" @lang('button.edit')" data-name="{{$school->name}}"
                                            data-welcome_screen="{{$school->welcome_screen}}"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                            title="@lang('button.delete')" id="deleteButton"
                                            data-id="{{$school->id}}">
                                        <i class="fa fa-trash" data-toggle="tooltip" title="@lang('button.delete')"></i>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- add activity modal --}}
    <div class="modal fade" id="storeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('schools.create_new_school')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('schools.create') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">@lang('schools.name') :</label>
                            <input type="text" class="form-control" id="recipient-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-form-label">@lang('schools.logo') :</label>
                            <input type="file" class="form-control dropify" id="logo" name="logo" data-height="120"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">@lang('schools.welcome_screen') :</label>
                            <textarea class="form-control" id="message-text" rows="4" name="welcome_screen"
                                      required placeholder="Welcome to school name"></textarea>
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

    <!--update  Modal -->
    <div class="modal fade" id="updateModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('schools.update_school')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('schools.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">@lang('schools.name') :</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="logo" class="col-form-label">@lang('schools.logo') :</label>
                            <input type="file" class="form-control dropify" id="logo" name="logo" data-height="120">
                        </div>
                        <div class="form-group">
                            <label for="welcome_screen" class="col-form-label">@lang('schools.welcome_screen') :</label>
                            <textarea class="form-control" id="welcome_screen" rows="4" name="welcome_screen"
                                      required></textarea>
                        </div>
                        <input type="hidden" class="form-control" id="id" name="id" >
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">@lang('button.close')</button>
                            <button type="submit" class="btn btn-primary">@lang('button.update')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#updateModel').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var welcome_screen = button.data('welcome_screen')
            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #name').val(name)
            modal.find('.modal-body #welcome_screen').text(welcome_screen)
        })
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
                    <h5><span class="text-danger">@lang('user.all')</span> @lang('alert.delete_school')</h5>
                    <br>
                    <h5> @lang('alert.delete_user5') </h5>
                </div>
                <form action="{{ route('schools.delete') }}" method="POST">
                    @csrf
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
        $('#deleteModal').on('show.bs.modal', function (event) {console.log('das');
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-footer input').val(id)

        })

    </script>

@endsection
