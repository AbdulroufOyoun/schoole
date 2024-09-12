@extends('layouts.admin_panel.main')
@section('header')
@lang('classroom.student_promotion')
@endsection

@section('content')

@if (session('error'))
<div class="alert alert-danger" role="alert"><button class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{ session('success') }}</div>
@endif
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
    <form method="POST" action="{{ route('classrooms.promotion') }}">
        @csrf
        <div class="card-header border-bottom-0">
            <h3 class="card-title">@lang('classroom.promotion_select_student')</h3>
            <button  type="submit" class="btn btn-success ml-auto"
            onclick="return confirm('@lang('alert.confirm_promotion')')">@lang('classroom.promotion_submit')</button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped card-table table-vcenter text-nowrap mb-0" style="text-align: center">
                    <thead>
                        <tr>
                            <th>*</th>
                            <th>@lang('classroom.name')</th>
                            <th>@lang('classroom.userName')</th>
                            <th>@lang('classroom.age')</th>
                            <th>@lang('classroom.section')</th>
                            <th>@lang('classroom.subject')</th>
                            <th>
                                @lang('classroom.checkbox')
                                <input type="checkbox" id="select-all-checkbox">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($students as $student)
                        <tr>
                            <th scope="row">{{ $i++; }}</th>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->UserName }}</td>
                            <td>{{ $student->date_of_birth }}</td>
                            <td>{{ $student->section->name }}</td>
                            <td>4\7</td>
                            <td><input type="checkbox" class="student-checkbox" name="ids[]" value="{{ $student->id }}" required></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- bd -->
        </div>
    </form>
</div>

<script>
    $(function(){

var requiredCheckboxes = $(':checkbox[required]');

requiredCheckboxes.change(function(){

    if(requiredCheckboxes.is(':checked')) {
        requiredCheckboxes.removeAttr('required');
    }

    else {
        requiredCheckboxes.attr('required', 'required');
    }
});

});
</script>
<script>
    document.getElementById('select-all-checkbox').addEventListener('change', function() {
        var checkboxes = document.getElementsByClassName('student-checkbox');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked;
        }
    });
</script>


@endsection
