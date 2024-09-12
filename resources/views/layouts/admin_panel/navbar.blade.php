@php
    $active_year = \App\Models\Year::where('activated',true)
    ->whereSchoolId(auth()->user()->school_id)
    ->first();
    if ($active_year){
        $active_year=$active_year->name;
    }
    else{
        $active_year='';
    }
    $academicMessages = \App\Models\Message::whereType(1)->latest()->take(3)->get();
    $adminsMessages = \App\Models\Message::whereType(2)->latest()->take(3)->get();
@endphp
<div class="app-header header">
    <div class="container-fluid">
        <div class="d-flex">
            <a class="header-brand" href="{{route('dashboard')}}">
                <img src="{{ asset($logo) }}" class="header-brand-img desktop-lgo" alt="TR KOLEJ"
                     style="max-height: 9vw;">
                <img src="{{ asset($logo) }}" class="header-brand-img dark-logo" alt="TR KOLEJ"
                     style="max-height: 9vw;">
                <img src="{{ asset($logo) }}" class="header-brand-img mobile-logo" alt="TR KOLEJ"
                     style="max-height: 9vw;">
                <img src="{{ asset($logo) }}" class="header-brand-img darkmobile-logo" alt="TR KOLEJ"
                     style="max-height: 9vw;">
            </a>
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#">
                    <i class="feather feather-menu"></i>
                </a>
                <a class="close-toggle" href="#">
                    <i class="feather feather-x"></i>
                </a>
            </div>
            {{-- avtive year --}}
            @if($user->role_id != 10)
                <div class=" mt-3 pl-5 d-none d-md-block">
                    <h4>@lang('years.activated_year', ['active_year' => $active_year])</h4>
                </div>
            @endif
            {{-- avtive year --}}
            <div class="d-flex order-lg-2 my-auto ml-auto">
                <div class="dropdown header-fullscreen">
                    <a class="nav-link icon full-screen-link">
                        <i class="feather feather-maximize fullscreen-button fullscreen header-icons"></i>
                        <i class="feather feather-minimize fullscreen-button exit-fullscreen header-icons"></i>
                    </a>
                </div>

                @if($user->role_id != 10)
                    {{--                messages          --}}
                    <div class="dropdown header-message">
                        <a class="nav-link icon" data-toggle="dropdown">
                            <i class="feather feather-mail header-icon"></i>
                            <span class="bg-dot bg-green"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow  animated">
                            <div class="header-dropdown-list message-menu" id="message-menu">
                                @can('admins messages')
                                    @foreach($adminsMessages as $message)
                                        <a class="dropdown-item border-bottom" style="max-width: 27vw;"
                                           href="{{ route('messages.get-admin-messages') }}">
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    @if($message->sender->image)
                                                        <span
                                                            class="avatar avatar-md brround align-self-center cover-image"
                                                            data-image-src="{{asset($message->sender->image)}}"></span>
                                                    @else
                                                        <span
                                                            class="avatar avatar-md brround align-self-center cover-image"
                                                            data-image-src="{{asset('admin_panel/assets/images/users/16.jpg')}}"></span>
                                                    @endif
                                                </div>
                                            <div class="d-flex">
                                                <div class="pl-3">
                                                    <h6 class="mb-1">{{$message->sender->name}}</h6>
                                                    <p class="fs-13 mb-1">{{ substr($message->subject, 0, 45) }} ...
                                                    <div class="small text-muted">
                                                        {{\Carbon\Carbon::parse($message->created_at)->diffForHumans()}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @endcan
                            @foreach($academicMessages as $message)
                                <a class="dropdown-item border-bottom" style="max-width: 27vw;"
                                   href="{{ route('messages.get-academic-messages')}}">
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            @if($message->sender->image)
                                                <span class="avatar avatar-md brround align-self-center cover-image"
                                                      data-image-src="{{asset($message->sender->image)}}"></span>
                                            @else
                                                <span class="avatar avatar-md brround align-self-center cover-image"
                                                      data-image-src="{{asset('admin_panel/assets/images/users/16.jpg')}}"></span>
                                            @endif
                                        </div>
                                        <div class="d-flex">
                                            <div class="pl-3">
                                                <h6 class="mb-1">{{$message->sender->name}}</h6>
                                                <p class="fs-13 mb-1">{{ substr($message->subject, 0, 45) }} ...
                                                </p>
                                                <div class="small text-muted">
                                                    {{\Carbon\Carbon::parse($message->created_at)->diffForHumans()}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            <div class=" text-center p-2">
                                <a href="{{ route('messages.get-academic-messages')}}" class="">
                                    @lang('user.see_academic_messages')</a>
                            </div>
                        </div>
                    </div>
                    {{--                messages          --}}

                    <div class="dropdown header-notify">
                        <a class="nav-link icon" data-toggle="sidebar-right" data-target=".sidebar-right">
                            <i class="feather feather-bell header-icon"></i>
                            <span class="bg-dot"></span>
                        </a>
                    </div>
                @endif

                <div class="dropdown profile-dropdown">
                    <a href="#" class="nav-link pr-1 pl-0 leading-none" data-toggle="dropdown">
                        <span>
                            @if($user->image)
                                <img src="{{ asset($user->image) }}" alt="img"
                                     class="avatar avatar-md bradius">
                            @else
                                <img src="{{ asset('admin_panel/assets/images/users/16.jpg') }}" alt="img"
                                     class="avatar avatar-md bradius">
                            @endif
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
                        <div class="p-3 text-center border-bottom">
                            <a class="text-center user pb-0 font-weight-bold">{{$user->name}}</a>
                            <p class="text-center user-semi-title">{{$user->account_type}}</p>
                        </div>
                        <a class="dropdown-item d-flex" href="{{route('user.profile')}}">
                            <i class="feather feather-user mr-3 fs-16 my-auto"></i>
                            <div class="mt-1">@lang('user.profile')</div>
                        </a>
                        @can('settings management')
                            <a class="dropdown-item d-flex" href="{{ route('settings.index') }}">
                                <i class="feather feather-settings mr-3 fs-16 my-auto"></i>
                                <div class="mt-1">@lang('sidebar.settings')</div>
                            </a>
                        @endcan
                        <a class="dropdown-item d-flex" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="feather feather-power mr-3 fs-16 my-auto"></i>
                            <div class="mt-1"> {{ __('Logout') }}</div>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- end header --}}
