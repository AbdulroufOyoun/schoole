@extends('layouts.admin_panel.main')
@section('header')
    @lang('subject.subject_teacher')
@endsection
@section('content')

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header border-bottom-0">
            <div class="card-title">@lang('subject.table_header')</div>
            <div class="dropdown ml-auto">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    @lang('subject.select_yaer')
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    @foreach ($years as $year)
                        <a class="dropdown-item" @if($year->id == $year_id) selected @endif href="{{
                    route('subject.filter_years',$year->id)}}">{{ $year->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="details-datatable"
                       class="table table-striped card-table table-vcenter text-nowrap mb-0 table-style ">
                    <thead>
                    <tr>
                        <th class="border-bottom-0">*</th>
                        <th class="border-bottom-0">@lang('subject.Teacher')</th>
                        <th class="border-bottom-0">@lang('subject.Subject')</th>
                        <th class="border-bottom-0">@lang('subject.Classroom')</th>
                        <th class="border-bottom-0">@lang('subject.Section')</th>
                        <th class="border-bottom-0">@lang('subject.Year')</th>
                        <th class="border-bottom-0">@lang('subject.modify')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $teacher->teacher->name }} {{ $teacher->teacher->last_name }}</td>
                            <td>{{ $teacher->subject->name }}</td>
                            <td>{{ $teacher->classroom->name }}</td>
                            <td>{{ $teacher->section->name }}</td>
                            <td>{{ $teacher->year->name }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{route('subject.edit_assign_teacher',$teacher->id)}}">
                                    Update
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- delete modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirm deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item ?
                </div>
                <form action="{{ route('subject.delete_teacher') }}" method="POST">
                    @csrf
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">delete</button>
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
