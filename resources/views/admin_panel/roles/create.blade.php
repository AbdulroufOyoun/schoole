@extends('layouts.admin_panel.main')

@section('header')
    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>@lang('roles.create_new_role')</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('roles.index') }}">@lang('button.back')</a>

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

    <div class="card p-5">


        {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group p-2">

                    <h4> <strong>@lang('roles.name') :</strong> </h4>

                    {!! Form::text('name', null, array('placeholder' => __('roles.name'),'class' => 'form-control')) !!}

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group p-2">

                    <h4><strong>@lang('roles.permissions') :</strong></h4>

                    <div class="row">

                        @foreach($permission as $value)

                            <div class="col-md-3" style="font-size: 2.5ch; margin: 2ch 0 0 0ch;">


                                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}

                                    {{ $value->name }}</label>

                            </div>

                        @endforeach

                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                    <button type="submit" class="btn btn-primary">@lang('button.submit')</button>

                </div>

            </div>

            {!! Form::close() !!}

        </div>

@endsection
