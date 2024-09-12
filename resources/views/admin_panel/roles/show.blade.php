@extends('layouts.admin_panel.main')
@section('header')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2> @lang('roles.show_role')</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('roles.index') }}"> @lang('button.back')</a>

        </div>

    </div>

</div>

@endsection

@section('content')




<div class="row card" style="padding: 3ch 0 ; font-size: 2ch;">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>@lang('roles.name') :</strong>

            {{ $role->name }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>@lang('roles.permissions') :</strong>

            @if(!empty($rolePermissions))

                @foreach($rolePermissions as $v)

                    <label class="text text-success">{{ $v->name }},</label>

                @endforeach

            @endif

        </div>

    </div>

</div>

@endsection
