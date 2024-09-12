@extends('layouts.admin_panel.main')
@section('header')
    @lang('user.create_accounts')
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="tab-menu-heading hremp-tabs p-0 ">
                <div class="tabs-menu1">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li class="ml-4"><a href="#tab5" class="active" data-toggle="tab">@lang('user.student')</a></li>
                        <li><a href="#tab6" data-toggle="tab">@lang('user.teacher')</a></li>
                        <li><a href="#tab7" data-toggle="tab">@lang('user.editor')</a></li>
                        <li><a href="#tab8" data-toggle="tab">@lang('user.Parent')</a></li>
                        @can('create admins acounts')
                            <li><a href="#tab88" data-toggle="tab">@lang('user.accountant')</a></li>
                            <li><a href="#tab9" data-toggle="tab">@lang('user.academic')</a></li>
{{--                            <li><a href="#tab99" data-toggle="tab">@lang('user.admin')</a></li>--}}
                        @endcan
                    </ul>
                </div>
            </div>
            @livewire('user.create')
        </div>
    </div>

@endsection
