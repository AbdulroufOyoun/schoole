<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessagesRequest\SendGroupMessageRequest;
use App\Http\Requests\MessagesRequest\SendMessageRequest;
use App\Http\Requests\MessagesRequest\SendReplyRequest;
use App\Models\Message;
use App\Models\User;
use App\Notifications\MessageNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function getMessages()
    {
        $messages = Message::whereAccepted(false)->whereSectionId(null)->whereType(null)->get();
        return view('admin_panel.messages.single-messages', compact('messages'));

    }

    public function acceptMessage($id)
    {
        $message = tap(Message::find($id), function ($message) {
            $message->update(['accepted' => true, 'accepted_at' => Carbon::now()]);
        });
//       send notification to user
        $user = User::find($message->user_id);
        $fcm_tokens[] = $user->fcm_token;
        $notification['subject'] = $message->subject;
        $notification['message'] = $message->message;
        \Notification::send(null, new MessageNotification($fcm_tokens, $notification));

        \Session::flash('success', __('alert.alert_accept'));
        return redirect()->back();

    }

    public function delete(Request $request)
    {
        Message::find($request->id)->delete();
        \Session::flash('success', __('alert.alert_delete'));
        return redirect()->back();
    }

    public function getGroupMessage()
    {
        $messages = Message::whereAccepted(false)->whereNotNull('section_id')->get();
        return view('admin_panel.messages.group-messages', compact('messages'));

    }

    public function acceptGroupMessage($id)
    {
        $message = tap(Message::find($id), function ($message) {
            $message->update(['accepted' => true, 'accepted_at' => Carbon::now()]);
        });
        #send notifications to all section students
        $users = User::where('school_id',auth()->user()->school_id)->whereHas('section', function ($section) use ($message) {
            $section->where('section_id', $message->section_id);
        })->get();
        $fcm_tokens = [];
        foreach ($users as $user) {
            $fcm_tokens[] = $user->fcm_token;
        }
        $notification = [
            'subject' => $message->subject,
            'message' => $message->message,
        ];
        \Notification::send(null, new MessageNotification($fcm_tokens, $notification));

        \Session::flash('success', __('alert.alert_accept'));
        return redirect()->back();

    }

    public function getMessageDetails($id)
    {
        $message = Message::find($id);
        return view('admin_panel.messages.message-details', compact('message'));
    }

    public function getAcademicMessages()
    {
        $messages = Message::whereType(5)->latest()->paginate(5);
        $type = 1;
        return view('admin_panel.messages.manager-messages', compact('messages','type'));

    }

    public function getAdminMessages()
    {
        $messages = Message::whereType(6)->latest()->paginate(5);
        $type = 2;
        return view('admin_panel.messages.manager-messages', compact('messages','type'));

    }

    public function replyMessage(SendReplyRequest $request)
    {
        $data = $request->validated();
        $replied = Message::where('reply_to_message', $data['reply_to_message'])->exists();
        if ($replied)
            return redirect()->back()->withErrors(['replied' => 'This message has been replied before']);
        $message = Message::create($data);
//       send notification to user
        $user = User::find($message->user_id);
        $fcm_tokens[] = $user->fcm_token;
        $notification['subject'] = $message->subject;
        $notification['message'] = $message->message;
        \Notification::send(null, new MessageNotification($fcm_tokens, $notification));

        \Session::flash('success', __('alert.alert_send'));
        return redirect()->back();
    }

    public function createMessage()
    {
        $users = User::select(['id','name','last_name'])->whereSchoolId(auth()->user()->school_id)->whereIn('role_id',[1,2,3,4])->get();
        return view('admin_panel.messages.create-message',compact('users'));

    }

    public function sendMessage(SendMessageRequest $request)
    {
        $data = $request->validated();
        $message = Message::create($data);
//       send notification to user
        $user = User::find($message->user_id);
        $fcm_tokens[] = $user->fcm_token;
        $notification['subject'] = $message->subject;
        $notification['message'] = $message->message;
        \Notification::send(null, new MessageNotification($fcm_tokens, $notification));

        \Session::flash('success', __('alert.alert_send'));
        return redirect()->back();
    }

    public function sendGroupMessage(SendGroupMessageRequest $request)
    {
        $data = $request->validated();
        $message = Message::create($data);
        #send notifications to all users
        $users = User::whereRoleId($data['type']);
        $fcm_tokens = [];
        foreach ($users as $user) {
            $fcm_tokens[] = $user->fcm_token;
        }
        $notification = [
            'subject' => $message->subject,
            'message' => $message->message,
        ];
        \Notification::send(null, new MessageNotification($fcm_tokens, $notification));

        \Session::flash('success', __('alert.alert_send'));
        return redirect()->back();
    }

    public function getSentMessages()
    {
        $admins_ids = User::whereSchoolId(auth()->user()->school_id)->whereIn('role_id',[5,6])->pluck('id');
        $messages = Message::whereIn('sender_id',$admins_ids)->get();
        return view('admin_panel.messages.sent-messages',compact('messages'));
    }

}
