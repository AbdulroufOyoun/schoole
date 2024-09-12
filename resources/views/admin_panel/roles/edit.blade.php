@extends('layouts.admin_panel.main')
@section('header')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>@lang('roles.edit_role')</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('roles.index') }}"> @lang('button.back')</a>

        </div>

    </div>

</div>
@endsection

@section('content')





@if (count($errors) > 0)

<div class="alert alert-danger">

    <strong>@lang('roles.whoops')</strong> @lang('roles.error_message')<br><br>

    <ul>

        @foreach ($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif



{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}

<div class="card">
    <div class="card-body">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>@lang('roles.name') :</strong>

                    {!! Form::text('name', null, array('placeholder' => __('roles.name'),'class' => 'form-control')) !!}

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>@lang('roles.permissions') :</strong>

                    <br /><br />
                    <div class="row">
                        @foreach($permission as $value)

                            <div class="col-md-3" style="font-size: 2.5ch; margin: 2ch 0 0 0ch;">
                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true :
                        false, array('class' => 'name')) }}

                                    {{ $value->name }}</label>
                            </div>

                        @endforeach
                    </div>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">@lang('button.submit')</button>

            </div>

        </div>

    </div>

</div>


{!! Form::close() !!}



@endsection
