@extends('layouts.admin_panel.main')
@section('header')
    @lang('user.user_managment')
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
            <h3 class="card-title">@lang('user.user_list')</h3>
            <div class="dropdown ml-auto mr-0">
                <div class="dropdown ml-auto mr-0">
                    <select id="section_id" class="form-control custom-select filter-select " style="width: 15ch;">
                        <option value="" selected>@lang('user.select_section')</option>
                    </select>
                </div>
            </div>

            <div class="dropdown ml-2 mr-0">
                <select name="classroom_id" id="classroom_id" class="form-control filter-select">
                    <option value="" selected>@lang('user.select_classroom')</option>
                    <option value="">@lang('user.all')</option>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="dropdown ml-2 ">
                <select name="account_type" id="account_type" class="form-control filter-select">
                    <option value="" selected>@lang('user.acount_type')</option>
                    <option value="">@lang('user.all')</option>
                    <option value="1">@lang('user.student')</option>
                    <option value="2">@lang('user.teacher')</option>
                    <option value="3">@lang('user.editor')</option>
                    <option value="4">@lang('user.Parent')</option>
                    @if(auth()->user()->account_type == 'admin')
                        <option value="7">@lang('user.accountant')</option>
                        <option value="5">@lang('user.academic')</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="card-body pt-2">
            <div class="table-responsive">
                <table class="table table-striped card-table table-vcenter text-nowrap mb-0 user-list"
                       style="text-align: center">
                    <thead>
                      <tr>
                        <th>*</th>
                        <th>@lang('user.fist_name')</th>
                        <th>@lang('user.last_name')</th>
                        <th>@lang('user.username')</th>
                        <th>@lang('user.phone')</th>
                        <th>@lang('user.acount_type')</th>
                        <th>@lang('user.modify')</th>
                    </tr>
                    </thead>
                    <tbody>
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
                    <span class="text-danger">@lang('user.all')</span>
                    @lang('alert.delete_user1')
                    <span class="text-danger">@lang('user.Parent') </span>
                    @lang('alert.delete_user2')
                    <br>
                    @lang('alert.delete_user3')
                    <span class="text-danger"> @lang('user.teacher') </span>
                    @lang('alert.delete_user4')
                    <br>
                    @lang('alert.delete_user5')
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
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-footer input').val(id)

        })

    </script>


    <!--delete Social media Modal -->
    <div class="modal fade" id="deleteSocialMediaModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLongTitle"
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
                    <span style="color: red">@lang('alert.delete_socialMedia_1')</span> @lang('alert.delete_socialMedia_2')
                </div>
                <form action="{{ route('user.delete-social-media') }}" method="POST">
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
        $('#deleteSocialMediaModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-footer input').val(id)

        })

    </script>




    @push('js')

        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    @endpush
    <script type="text/javascript">
        $(function () {

            let table = $('.user-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('user.list') }}",
                    type: "post",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                        d.account_type = $('#account_type').val()
                        d.classroom_id = $('#classroom_id').val()
                        d.section_id = $('#section_id').val()

                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'UserName', name: 'UserName'},
                    {data: 'phone', name: 'phone'},
                    {data: 'type', name: 'type'},

                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
            $('.filter-select').change(function () {
                table.draw();
            });

        });

    </script>

    {{-- hidden select --}}
    <script>
        $(document).ready(function () {
            // hide the classroom_id select on page load
            $("#classroom_id").hide();
            $("#section_id").hide();


            // show/hide the classroom_id select when the account_type select changes
            $("#account_type").change(function () {
                if ($(this).val() == 1) {
                    $("#classroom_id").show();
                    // $("#section_id").show();
                    $('#section_id').parent().show();

                } else {
                    $("#classroom_id").hide();
                    // $("#section_id").hide();

                    $('#section_id').parent().hide();
                }
            });
        });
    </script>

    {{-- filter section --}}
    <script>
        $(document).ready(function () {
            $('#classroom_id').on('change', function () {

                let url = '{{ route('subject.filter_section',':id') }}';
                let country_id = $('#classroom_id').val();
                url = url.replace(':id', country_id);


                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    success: function (jsonObject) {
                        $("#section_id").empty();
                        $('#section_id').append($('<option>', {
                            value: "all",
                            text: 'all'
                        }));
                        $('#section_id').select2({data: jsonObject});

                    }
                });
            });
        });
    </script>

@endsection
