@extends('layouts.admin_panel.main')
@section('header')
    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>@lang('schools.schools_admins')</h2>

            </div>

            <div class="pull-right">
                <a type="button" class="btn btn-primary" href="{{route('schools.create-admin')}}">
                    @lang('schools.create_admin')
                </a>
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
                        <th>@lang('schools.admin_name')</th>
                        <th>@lang('schools.email')</th>
                        <th>@lang('schools.phone')</th>
                        <th>@lang('schools.name')</th>
                        <th>@lang('button.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach ($admins as $admin)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $admin->name }} {{$admin->last_name}}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phone }}</td>
                            <td>{{ $admin->school->name }}</td>
                            <td>
                                <a class="btn btn-blue" title="@lang('button.edit')"
                                   href="{{route('user.edit',$admin->id)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                        title="@lang('button.delete_account')" id="deleteButton"
                                        data-id="{{$admin->id}}">
                                    <i class="fa fa-trash" data-toggle="tooltip" title="@lang('button.delete_account')"></i>
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
                    <h5><span class="text-danger">@lang('user.all')</span> @lang('alert.delete_admin')</h5>
                    <br>
                    <h5> @lang('alert.delete_user5') </h5>
                </div>
                <form action="{{ route('user.delete') }}" method="POST">
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


