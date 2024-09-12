@php
    $report = \App\Models\Report::where('type','posts')->where('created_at','>',\Carbon\Carbon::now()->subWeek())->count();
    $postRejected = \App\Models\Post::whereNotNull('reason_reject')->where('updated_at','>',\Carbon\Carbon::now()->subWeek())->count();
    $message = \App\Models\Message::whereAccepted(false)->whereSectionId(null)->whereType(null)->count();
    $groupMessages = \App\Models\Message::whereAccepted(false)->whereSectionId(!null)->count();
@endphp
<div class="sidebar sidebar-right sidebar-animate">
    <div class="card-header border-bottom pb-5">
        <h4 class="card-title">@lang('user.notifications') </h4>
        <div class="card-options">
            <a href="#" class="btn btn-sm btn-icon btn-light  text-primary" data-toggle="sidebar-right"
               data-target=".sidebar-right"><i class="feather feather-x"></i> </a>
        </div>
    </div>
    <div class="">
        @if($report > 0)
            <div class="list-group-item  align-items-center border-0">
                <div class="d-flex">
                <span class="avatar avatar-lg brround mr-3 bg-yellow">
                    <i class="feather feather-instagram"></i>
                </span>
                    <a href="{{ route('posts.getPostsRerports') }}" class="font-weight-semibold fs-16">
                        <div class="mt-1">
                        <span class="text-muted font-weight-normal">
                            @lang('user.notifications_reports_posts',['number' =>$report])
                        </span>
                            <span class="clearfix"></span>
                        </div>
                    </a>
                </div>
            </div>
        @endif
        @if($message > 0)
            <div class="list-group-item  align-items-center border-0">
                <div class="d-flex">
                <span class="avatar avatar-lg brround mr-3 bg-cyan">
                    <i class="feather feather-mail"></i>
                </span>
                    <a href="{{ route('messages.get-messages')  }}" class="font-weight-semibold fs-16">
                        <div class="mt-1">
                        <span class="text-muted font-weight-normal">
                            @lang('user.notifications_messages',['number' =>$message])
                        </span>
                            <span class="clearfix"></span>
                        </div>
                    </a>
                </div>
            </div>
        @endif
        @if($postRejected > 0)
            <div class="list-group-item  align-items-center border-0">
                <div class="d-flex">
                <span class="avatar avatar-lg brround mr-3 bg-yellow">
                    <i class="feather feather-instagram"></i>
                </span>
                    <a href="{{ route('posts.getRejectedPosts') }}" class="font-weight-semibold fs-16">
                        <div class="mt-1">
                        <span class="text-muted font-weight-normal">
                           @lang('user.notifications_rejected_posts',['number' =>$postRejected])
                        </span>
                            <span class="clearfix"></span>
                        </div>
                    </a>
                </div>
            </div>
        @endif
        @if($groupMessages > 0)
            <div class="list-group-item  align-items-center border-0">
                <div class="d-flex">
                <span class="avatar avatar-lg brround mr-3 bg-cyan">
                    <i class="feather feather-mail"></i>
                </span>
                    <a href="{{ route('messages.get-group-messages') }}" class="font-weight-semibold fs-16">
                        <div class="mt-1">
                        <span class="text-muted font-weight-normal">
                            @lang('user.notifications_group_messages',['number' =>$groupMessages])
                        </span>
                            <span class="clearfix"></span>
                        </div>
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

