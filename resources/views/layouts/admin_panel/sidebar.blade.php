@php    $logo = $user->role_id == 10 ? asset('admin_panel/assets/images/logo.png') : $school->logo ; @endphp
<aside class="app-sidebar">
    <div class="app-sidebar__logo">
        <a class="header-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset($logo) }}" class="header-brand-img desktop-lgo" alt="Tr KOLEJ" style="max-height: 12vh; margin-top: -17px;">
            <img src="{{ asset($logo) }}" class="header-brand-img dark-logo" alt="Tr KOLEJ" style="max-height: 12vh; margin-top: -17px;">
            <img src="{{ asset($logo) }}" class="header-brand-img mobile-logo" alt="Tr KOLEJ" style="max-height: 12vh; margin-top: -17px;">
            <img src="{{ asset($logo) }}" class="header-brand-img darkmobile-logo" alt="Tr KOLEJ" style="max-height: 12vh; margin-top: -17px;">
        </a>
    </div>
    <div class="app-sidebar3">
        <div class="app-sidebar__user">
            <div class="dropdown user-pro-body text-center">
                <div class="user-pic">
                    @if($user->image)
                        <img src="{{ asset($user->image) }}"
                             class="avatar-xxl rounded-circle mb-1">
                    @else
                        <img src="{{ asset('admin_panel/assets/images/users/16.jpg') }}" alt="user-img"
                             class="avatar-xxl rounded-circle mb-1">
                    @endif
                </div>
                <div class="user-info">
                    <h5 class=" mb-2">{{$user->name}}</h5>
                    <span class="text-muted app-sidebar__user-name text-sm">{{$user->account_type}}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category mt-4">@lang('sidebar.dashboard')</li>
            @if(auth()->user()->role_id == 10)
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{route('schools.index')}}">
                        <i class="fe fe-book  sidemenu_icon"></i>
                        <span class="side-menu__label">@lang('sidebar.schools')</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ route('roles.index') }}">
                        <i class="fe fe-server  sidemenu_icon"></i>
                        <span class="side-menu__label">@lang('sidebar.role_management')</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{route('schools.create-admin')}}">
                        <i class="fe fe-user-plus  sidemenu_icon"></i>
                        <span class="side-menu__label">@lang('sidebar.create_schools_admins')</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{route('schools.admins')}}">
                        <i class="fe fe-list  sidemenu_icon"></i>
                        <span class="side-menu__label">@lang('sidebar.schools_admins_list')</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{route('settings.index')}}">
                        <i class="fe fe-settings  sidemenu_icon"></i>
                        <span class="side-menu__label">@lang('sidebar.settings')</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{route('advertising.activtes')}}">
                        <i class="fe fe-activity  sidemenu_icon"></i>
                        <span class="side-menu__label">@lang('sidebar.activities')</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{route('settings.advertising-teacher')}}">
                        <i class="fe fe-user-check  sidemenu_icon"></i>
                        <span class="side-menu__label">@lang('sidebar.advertising_teacher')</span>
                    </a>
                </li>


            @else

                @can('create-accounts')
                    <li class="slide ">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="feather feather-user sidemenu_icon"></i>
                            <span class="side-menu__label">@lang('sidebar.user_management')</span><i class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            <li><a href="{{ route('user.create') }}" class="slide-item">@lang('sidebar.add_new_user')</a></li>
                            <li><a href="{{ route('user.index') }}" class="slide-item">@lang('sidebar.users_list')</a></li>
                        </ul>
                    </li>
                @endcan
                @can('settings management')
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="fe fe-settings  sidemenu_icon"></i>
                            <span class="side-menu__label">@lang('sidebar.settings')</span><i class="angle fa fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a href="{{ route('settings.years') }}" class="slide-item">@lang('sidebar.years')</a></li>
                            <li><a href="{{ route('settings.school-settings') }}" class="slide-item">@lang('sidebar.settings')</a></li>
                        </ul>
                    </li>
                @endcan
                @can('Classroom management')
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="feather feather-home sidemenu_icon"></i>
                            <span class="side-menu__label">@lang('sidebar.classes_management')</span><i
                                class="angle fa fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a href="{{ route('classrooms.index') }}" class="slide-item">@lang('sidebar.classes')</a>
                            </li>
                            @can('subjects management')
                                <li><a href="{{ route('subject.index') }}" class="slide-item">@lang('sidebar.subjects')</a></li>
                                <li><a href="{{ route('subject.assign_teacher') }}" class="slide-item">@lang('sidebar.assign_teachers')</a>
                                </li>
                                <li><a href="{{ route('subject.teacher') }}" class="slide-item">@lang('sidebar.subjects_teachers')</a></li>
                            @endcan
                            @can('advance student')
                                <li><a href="{{ route('classrooms.select-option') }}" class="slide-item">@lang('sidebar.students_promotion')</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                {{-- socail media --}}
                @can('social media management')
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="feather feather-instagram sidemenu_icon"></i>
                            <span class="side-menu__label">@lang('sidebar.social_media')</span><i class="angle fa fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a href="{{ route('posts.getRejectedPosts') }}" class="slide-item">@lang('sidebar.posts_rejected')</a></li>
                            <li><a href="{{ route('posts.getPostsRerports') }}" class="slide-item">@lang('sidebar.posts_reports')</a></li>
                        </ul>
                    </li>
                @endcan
                @can('calendar management')
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="feather feather-calendar sidemenu_icon"></i>
                            <span class="side-menu__label">@lang('sidebar.calendar')</span><i class="angle fa fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a href="{{ route('calender.index') }}" class="slide-item">@lang('sidebar.calendar')</a></li>
                            <li><a href="{{ route('calender.create') }}" class="slide-item">@lang('sidebar.add_new_event')</a></li>
                        </ul>
                    </li>
                @endcan
                @can('plans management')
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="feather feather-folder-minus sidemenu_icon"></i>
                            <span class="side-menu__label">@lang('sidebar.yearly_plans')</span><i class="angle fa fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a href="{{ route('plans.annual-plans') }}" class="slide-item">@lang('sidebar.annual_plans')</a></li>
                            <li><a href="{{ route('plans.lesson-plans') }}" class="slide-item">@lang('sidebar.lesson_plans')</a></li>
                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="fa fa-book sidemenu_icon"></i>
                            <span class="side-menu__label">@lang('sidebar.weekly_plans')</span><i class="angle fa fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="sub-slide">
                                <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span
                                        class="sub-side-menu__label">@lang('sidebar.school_schedule')</span><i
                                        class="sub-angle fa fa-angle-right"></i></a>
                                <ul class="sub-slide-menu">
                                    <li><a class="sub-slide-item" href="{{route('plans.CreateSchoolSchedule')}}">@lang('sidebar.update_schedule')</a></li>
                                    <li><a class="sub-slide-item" href="{{route('plans.selectSection')}}">@lang('sidebar.school_schedule')</a></li>
                                </ul>
                            </li>

                            <li><a href="{{ route('weekly-plans.index') }}" class="slide-item">@lang('sidebar.weeks')</a></li>

                        </ul>
                    </li>
                @endcan
                @can('messages')
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="feather feather-mail sidemenu_icon"></i>
                            <span class="side-menu__label">@lang('sidebar.messages')</span><i class="angle fa fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a href="{{ route('messages.get-messages') }}" class="slide-item">@lang('sidebar.messages')</a></li>
                            <li><a href="{{ route('messages.get-group-messages') }}" class="slide-item">@lang('sidebar.group_messages')</a>
                            </li>
                            <li><a href="{{ route('messages.get-academic-messages') }}" class="slide-item">@lang('sidebar.academics_messages')</a></li>
                            @can('admins messages')
                                <li><a href="{{ route('messages.get-admin-messages') }}" class="slide-item">@lang('sidebar.admins_messages')</a></li>
                            @endcan
                            <li><a href="{{ route('messages.create-message') }}" class="slide-item">@lang('sidebar.send_message')</a></li>
                            <li><a href="{{ route('messages.sent-messages') }}" class="slide-item">@lang('sidebar.sent_messages')</a></li>
                        </ul>
                    </li>
                @endcan
                @can('payment management')
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="fa fa-dollar sidemenu_icon"></i>
                            <span class="side-menu__label">@lang('sidebar.payments')</span><i class="angle fa fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a href="{{ route('payment.get-students-fees') }}" class="slide-item">@lang('sidebar.students_fees')</a></li>
                            <li><a href="{{ route('payment.get-parents-payments') }}" class="slide-item">@lang('sidebar.parents_payments')</a></li>
                        </ul>
                    </li>
                @endcan
                @can('marks management')
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="feather feather-sliders sidemenu_icon"></i>
                            <span class="side-menu__label">@lang('sidebar.marks_management')</span><i class="angle fa fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a href="{{ route('semesters.get-semesters') }}" class="slide-item">@lang('sidebar.semesters_management')</a></li>
                            <li><a href="{{ route('terms.get-terms') }}" class="slide-item">@lang('sidebar.terms_management')</a></li>
                            <li><a href="{{ route('marks.config-subjects-marks') }}" class="slide-item">@lang('sidebar.config_subjects_marks')</a></li>
                            <li><a href="{{ route('marks.marks-configuration') }}" class="slide-item">@lang('sidebar.marks_configuration')</a></li>
                            <li><a href="{{ route('marks.get-subject-marks') }}" class="slide-item">@lang('sidebar.students_marks')</a></li>
                            <li><a href="{{ route('marks.select-student') }}" class="slide-item">@lang('sidebar.student_grade')</a></li>
                        </ul>
                    </li>
                @endcan
            @endif
        </ul>
    </div>
</aside>
