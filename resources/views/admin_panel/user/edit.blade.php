@extends('layouts.admin_panel.main')
@section('header')
    @lang('user.update_the_account')
@endsection
@section('content')
<div>
    @if (session('success'))
    <div class="alert alert-success" role="alert"><button class="close" data-dismiss="alert"
            aria-hidden="true">×</button> {{ session('success') }}</div>
    @endif
</div>
<!-- Row -->
<div>
    <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
        <div class="tab-content">
            <div class="tab-pane active" id="tab5">
                <form action="{{ route('user.update') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="card-body">
                        <h4 class="mb-4 font-weight-bold">@lang('user.user_account') </h4>
                        @if ($user->image)
                        <div class="form-group">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <img src="{{ asset($user->image) }}" class="img-fluid" style="max-height: 30ch;">
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.fist_name')</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control mb-md-0 mb-5" placeholder="@lang('user.fist_name')"
                                                name="name" value="{{ $user->name }}" required>
                                            @error('name')
                                            <span class="text-danger">{{ $message}}</span>
                                            @enderror
                                            <span class="text-muted"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.last_name')</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control mb-md-0 mb-5" placeholder="@lang('user.last_name')"
                                                   name="last_name" value="{{ $user->last_name }}" required>
                                            @error('last_name')
                                            <span class="text-danger">{{ $message}}</span>
                                            @enderror
                                            <span class="text-muted"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($user->account_type == 'student')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">@lang('user.father_name')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control mb-md-0 mb-5" placeholder="@lang('user.father_name')"
                                                       name="father_name" value="{{ $user->father_name }}" required>
                                                @error('father_name')
                                                <span class="text-danger">{{ $message}}</span>
                                                @enderror
                                                <span class="text-muted"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">@lang('user.mother_name')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control mb-md-0 mb-5" placeholder="@lang('user.mother_name')"
                                                       name="mother_name" value="{{ $user->mother_name }}" required>
                                                @error('mother_name')
                                                <span class="text-danger">{{ $message}}</span>
                                                @enderror
                                                <span class="text-muted"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($user->account_type == 'teacher')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.teacher_section')</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control mb-md-0 mb-5" placeholder="@lang('user.teacher_section')"
                                                name="teacher_section" value="{{ $user->teacher_section }}" required>
                                            @error('teacher_section')
                                            <span class="text-danger">{{ $message}}</span>
                                            @enderror
                                            <span class="text-muted"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if ($user->account_type == 'student')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.parent_username') </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control custom-select select2 mySelect2" name="parent">
                                        <option label="@lang('button.select')"></option>
                                        @foreach ($parents as $parent)
                                        <option value="{{ $parent->id }}" @if($user->parent == $parent->id) selected
                                            @endif>
                                            {{ $parent->UserName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="margin-left: 26%">
                                    @error('parent') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.classroom')</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control custom-select select2 mySelect2" name="classroom" id="classroom">
                                        <option @lang('button.select')></option>
                                        @foreach ($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}" @if($user->classroom && $classroom->id == $user->classroom->id)
                                            selected @endif>
                                            {{ $classroom->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="margin-left: 26%">
                                    @error('classroom') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.section')</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control custom-select select2 mySelect2" name="section" id="section">
                                        <option label="@lang('button.select')"></option>
                                        @if ($sections)
                                        @foreach ($sections as $section)
                                        <option value="{{ $section->id }}" @if($section->id == $user->section->id)
                                            selected @endif >
                                            {{ $section->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div style="margin-left: 26%">
                                    @error('section') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.phone')</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="@lang('user.phone')" name="phone"
                                        value="{{ $user->phone }}" required>
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.email')</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" placeholder="@lang('user.email')" name="email"
                                        value="{{ $user->email }}" required>
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        @if ($user->account_type == 'student' || $user->account_type == 'teacher')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.date_of_birth')</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" class="form-control fc-datepicker"
                                        name="date_of_birth" value="{{ $user->date_of_birth }}" required>
                                    @error('date_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        @endif
                        @if ($user->account_type == 'student' || $user->account_type == 'teacher' || $user->account_type == 'editor')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">@lang('user.gender')</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="custom-controls-stacked d-md-flex">
                                        <label class="custom-control custom-radio mr-4">
                                            <input type="radio" class="custom-control-input" name="gender" value="1"
                                                @if($user->gender == 'Male') checked @endif required>
                                            <span class="custom-control-label">@lang('user.male')</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="gender" value="2"
                                                @if($user->gender == 'Female') checked @endif required>
                                            <span class="custom-control-label">@lang('user.female')</span>
                                        </label>
                                        @error('gender') <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if ($user->account_type == 'student' || $user->account_type == 'teacher')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">@lang('user.languages')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control mb-md-0 mb-5" placeholder="@lang('user.languages')"
                                                       name="languages" value="{{ $user->languages }}" required>
                                                @error('languages')
                                                <span class="text-danger">{{ $message}}</span>
                                                @enderror
                                                <span class="text-muted"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($user->account_type != 'editor')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-label mb-0 mt-2">@lang('user.upload_photo')</div>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group file-browser">
                                        <input type="text" class="form-control border-right-0 browse-file"
                                            placeholder="@lang('user.choose')" readonly="" name="image">
                                        <label class="input-group-append mb-0">
                                            <span class="btn ripple btn-primary">
                                                @lang('user.browse') <input type="file" class="file-browserinput"
                                                    style="display: none;" name="image">
                                            </span>
                                        </label>
                                        @error('image') <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <h4 class="mb-5 mt-7 font-weight-bold">@lang('user.account_login')</h4>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.username')</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="@lang('user.username')"
                                        name="UserName" value="{{ $user->UserName }}" required>
                                    @error('UserName') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.password')</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" placeholder="@lang('user.password')"
                                        name="password">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                {{--  --}}
                                <input type="hidden" name="role_id" value="{{$user->role_id}}">
                                @error('role_id') <span class="text-danger">{{ $message }}</span> @enderror
                                <input type="hidden" name="id" value="{{ $user->id }}">

                                {{--  --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.account_permission')</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="roles[]" class="form-control select2"
                                        data-placeholder="@lang('button.select')" multiple="">
                                        <option label="Select"></option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            @if(in_array( $role->id,$user->roles->pluck('id')->toArray())) selected @endif>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-left">
                        <button type="submit" class="btn btn-primary">@lang('button.update')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Row-->
<script>
    $( document ).ready(function() {
        $('#classroom').on('change', function () {
                console.log('das');
                // $("#section").empty();
                let url = '{{ route('subject.filter_section',':id') }}';
                let country_id= $('#classroom').val();
                url = url.replace(':id',country_id);


                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    success: function (jsonObject){
                        $('#section').empty();
                        $('#section').select2({ data: jsonObject });
                    }
                });
            });
        $('.select2').select2()
    });
</script>
</div>

@endsection
