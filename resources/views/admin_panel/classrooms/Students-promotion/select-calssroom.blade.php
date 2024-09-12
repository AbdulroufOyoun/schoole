@extends('layouts.admin_panel.main')
@section('header')
@lang('classroom.student_promotion')
@endsection
@section('content')
@if ($message)
<div class=" message-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6 justify-content-center mx-auto text-center">
                <div class="card">
                    <div class="card-body p-8 text-center">
                        <img src="{{ asset('admin_panel') }}/assets/images/svgs/delete.svg" alt="img" class="w-15">
                        <h3 class="mt-5">@lang('alert.message_error')</h3>
                        <p class="mt-3 mb-5"> @lang('alert.no_new_year') </p>
                        <a class="btn ripple btn-primary" href="{{ route('settings.years') }}">@lang('years.add')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
@if (session('success'))
<div class="alert alert-success" role="alert"><button class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{ session('success') }}</div>
@endif

<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <form method="POST" action="{{ route('classrooms.select_students') }}">
            @csrf
            {{-- from card --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('classroom.from')</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group ">
                                <label class="form-label">@lang('subject.classroom')</label>
                                <select class="form-control select2 custom-select" name="from_classroom_id"
                                    data-placeholder="@lang('subject.Choose')" id="from_classroom_id" required>
                                    <option label="@lang('subject.Choose')"></option>
                                    @foreach ($classrooms as $classroom)
                                    <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                    @endforeach
                                </select>
                                @error('from_classroom_id')
                                <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                    {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label class="form-label">@lang('subject.section')</label>
                                <select class="form-control select2 custom-select" multiple name="from_section_ids[]"
                                    data-placeholder="@lang('subject.Choose')" id="from_section" required>
                                    <option label="@lang('subject.Choose')"></option>
                                </select>
                                @error('from_section_ids')
                                <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                    {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- to card --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('classroom.to')</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">

                        <div class="form-group">
                            <div class="form-group ">
                                <label class="form-label">@lang('subject.classroom')</label>
                                <select class="form-control select2 custom-select" name="to_classroom_id"
                                    data-placeholder="@lang('subject.Choose')" id="to_classroom_id" required>
                                    <option label="@lang('subject.Choose')"></option>
                                    @foreach ($classrooms as $classroom)
                                    <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                    @endforeach
                                </select>
                                @error('to_classroom_id')
                                <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                    {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label class="form-label">@lang('subject.section')</label>
                                <select class="form-control select2 custom-select"  name="to_section_id"
                                    data-placeholder="@lang('subject.Choose')" id="to_section" required>
                                    <option label="@lang('subject.Choose')"></option>
                                </select>
                                @error('to_section_ids')
                                <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                    {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer mx-auto">
                    <button type="submit" class="btn btn-success"  name="action" value="promotion" >@lang('button.promotion')</button>
                    <button type="submit" class="btn btn-danger"  name="action" value="deposition" >@lang('button.deposition')</button>
                </div>
            </div>
        </form>

    </div>
</div>


<script>
    $( document ).ready(function() {
    $('#from_classroom_id').on('change', function () {

            $("#from_section").empty();
            let url = '{{ route('subject.filter_section',':id') }}';
            let classroom_id= $('#from_classroom_id').val();
            url = url.replace(':id',classroom_id);


            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function (jsonObject){
                    $('#from_section').select2({ data: jsonObject });
                }
            });
        });

        $('#to_classroom_id').on('change', function () {

        $("#to_section").empty();
        let url = '{{ route('subject.filter_section',':id') }}';
        let classroom_id= $('#to_classroom_id').val();
        url = url.replace(':id',classroom_id);


        $.ajax({
           url: url,
           type: 'get',
           dataType: 'json',
          success: function (jsonObject){
              $('#to_section').select2({ data: jsonObject });
          }
        });
});

});

</script>



@endif

@endsection
