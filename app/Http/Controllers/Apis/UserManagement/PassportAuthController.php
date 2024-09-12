<?php

namespace App\Http\Controllers\Apis\UserManagement;

use App\Http\Controllers\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageTrait;
use App\Http\Requests\Apis\MessageRequest\ReplyMessage;
use App\Http\Requests\Apis\MessageRequest\SendUserMessage;
use App\Http\Requests\Apis\UserRequest\ChangePasswordRequest;
use App\Http\Requests\Apis\UserRequest\UpdateTokenRequest;
use App\Http\Requests\Apis\UserRequest\UpdateUserRequest;
use App\Http\Resources\UserResource\ProfileResource;
use App\Models\Follow;
use App\Models\Like;
use App\Models\Message;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;


class PassportAuthController extends Controller
{

    use ApiResponseTrait;
    use ImageTrait;

    public function login(Request $request)
    {
        $login_credentials = [
            'UserName' => $request->UserName,
            'password' => $request->password,
        ];
        if (auth()->attempt($login_credentials)) {

            $data = new ProfileResource(auth()->user());

            $data = $data->toArray(request());

            $data['token'] = auth()->user()->createToken('Berneshti@gmail.io')->accessToken;
            return $this->apiResponse($data, true, null, 200);

        } else {
            return $this->unAuthoriseResponse();
        }
    }

    public function FcmToken(UpdateTokenRequest $request)
    {
        $data = $request->validated();
        $user = User::find($data['id']);
        $user->update(['fcm_token' => $data['fcm_token']]);
        return $this->apiResponse("FCM Token Update successfully");
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->apiResponse("logged Successfully", true, false, 200);
    }

    public function profile()
    {
        $user = auth()->user();
        $data = new ProfileResource($user);
        return $this->apiResponse($data, true, null, 200);
    }

    public function update(UpdateUserRequest $request)
    {

        $data = $request->validated();
        $item = auth()->user();
        $item->hobbies = $data['hobbies'];
        $item->languages = $data['languages'];
        $item->date_of_birth = $data['date_of_birth'];
        $item->phone = $data['phone'];
        $item->country = $data['country'];
        $item->about_me = $data['about_me'];
        if ($request->hasFile('image')) {
            $this->deleteImage($item->image);
            $item->image = $this->uploadImage($data['image']);
        }
        $item->update();

        $data = new ProfileResource($item);
        return $this->apiResponse($data, true, false, 200);

    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        if (Hash::check($data['oldPassword'], $user->password)) {
            $user->update(['password' => Hash::make($data['newPassword'])]);
            return $this->apiResponse("Password changed successfully");
        }
        return $this->apiResponse(null, 0, "the old password is wroung", 400);

    }

    public function showProfile($id)
    {

        $item = User::find($id);

        if ($item) {
            $data = new ProfileResource($item);
            return $this->apiResponse($data, true, false, 200);
        }
        return $this->apiResponse(null, false, "the user not found", 422);


    }

    public function like($profile_id)
    {

        $user = auth()->user();
        if (User::find($profile_id)) {

            $exist = Like::where(['user_id' => $user->id, 'profile_id' => $profile_id])->exists();
            if ($exist) {
                Like::where(['user_id' => $user->id, 'profile_id' => $profile_id])->delete();
                return $this->apiResponse("disliked Successfully", true, false, 200);
            }
            Like::create(['user_id' => auth()->user()->id, 'profile_id' => $profile_id]);
            return $this->apiResponse("liked Successfully", true, false, 200);

        } else {
            return $this->notFound();
        }


    }

    public function likers($id = null)
    {
        if ($id) {
            $user = User::find($id);
            if ($user) {
                $likers = Like::where('profile_id', $id)
                    ->with('user')
                    ->get(['user_id'])
                    ->map(function ($item) {
                        return [
                            'user id' => $item->user_id,
                            'name' => $item->user->name,
                            'image' => $item->user->image,
                        ];
                    })
                    ->toArray();

                return $this->apiResponse($likers, true, false, 200);
            } else {
                return $this->apiResponse(null, true, "the user not found", 200);
            }

        }
        $likers = Like::where('profile_id', auth()->user()->id)
            ->with('user')
            ->get(['user_id'])
            ->map(function ($item) {
                return [
                    'user id' => $item->user_id,
                    'name' => $item->user->name.' '.$item->user->last_name,
                    'image' => $item->user->image ? $item->user->image : null,
                ];
            })
            ->toArray();

        return $this->apiResponse($likers, true, false, 200);
    }

    public function follow($profile_id)
    {
        $user = auth()->user();
        if (User::find($profile_id)) {
            $exist = Follow::where(['user_id' => $user->id, 'profile_id' => $profile_id])->exists();
            if ($exist) {
                Follow::where(['user_id' => $user->id, 'profile_id' => $profile_id])->delete();
                return $this->apiResponse("unfollowed Successfully", true, false, 200);
            }
            Follow::create(['user_id' => auth()->user()->id, 'profile_id' => $profile_id]);
            return $this->apiResponse("followed Successfully", true, false, 200);
        } else {
            return $this->notFound();
        }


    }

    public function followers($id = null)
    {
        if ($id) {
            $user = User::find($id);
            if ($user) {
                $followers = Follow::where('profile_id', $id)
                    ->with('user')
                    ->get(['user_id'])
                    ->map(function ($item) {
                        return [
                            'user id' => $item->user_id,
                            'name' => $item->user->name,
                            'image' => $item->user->image ? $item->user->image : null,
                        ];
                    })
                    ->toArray();

                return $this->apiResponse($followers, true, false, 200);
            } else {
                return $this->apiResponse(null, true, "the user not found", 200);
            }

        }
        $followers = Follow::where('profile_id', auth()->user()->id)
            ->with('user')
            ->get(['user_id'])
            ->map(function ($item) {
                return [
                    'user id' => $item->user_id,
                    'name' => $item->user->name.' '.$item->user->last_name,
                    'image' => $item->user->image,
                ];
            })
            ->toArray();

        return $this->apiResponse($followers, true, false, 200);
    }

    public function following($id = null)
    {
        if ($id) {
            $user = User::find($id);
            if ($user) {
                $followings = Follow::where('user_id', $id)
                    ->with('user')
                    ->get()
                    ->map(function ($item) {
                        return [
                            'user id' => $item->profile->id,
                            'name' => $item->profile->name,
                            'image' => $item->profile->image,
                        ];
                    })
                    ->toArray();

                return $this->apiResponse($followings, true, false, 200);
            } else {
                return $this->apiResponse(null, true, "the user not found", 200);
            }

        }
        $followings = Follow::where('user_id', auth()->user()->id)
            ->with('user')
            ->get()
            ->map(function ($item) {
                return [
                    'user id' => $item->profile->id,
                    'name' => $item->profile->name.' '.$item->profile->last_name,
                    'image' => $item->profile->image,
                ];
            })
            ->toArray();

        return $this->apiResponse($followings, true, false, 200);
    }

    public function getNotifications()
    {
        $notificationsQuery = Notification::where('user_id', auth()->user()->id)->latest()->paginate(10);
        $unReadNotifications = 0;
        $notificationsData = $notificationsQuery->map(function ($notification) use (&$unReadNotifications) {
            if ($notification->read == 0) {
                $unReadNotifications += 1;
            }
            return [
                'id' => $notification->id,
                'title' => $notification->title,
                'body' => $notification->body,
                'url' => $notification->url,
                'read' => $notification->read,
                'type' => $notification->type,
                'date' => Carbon::create($notification->created_at)->format('Y/m/d h:i a'),

            ];
        })->toArray();

        $notificationsData['unReadNotifications'] = $unReadNotifications;
        $notificationsData['next_page_url'] = $notificationsQuery->nextPageUrl();
        $notificationsData['previous_page_url'] = $notificationsQuery->previousPageUrl();
        return $this->apiResponse($notificationsData);
    }

    public function readNotifications(int $id)
    {
        $notification = Notification::find($id);
        if ($notification->read == 0) {
            $notification->update(['read' => true]);
            return $this->apiResponse('the notification readed successfully');
        }
        return $this->apiResponse('it\'s readed');
    }

    public function getMessages()
    {
        $user = auth()->user();
        if ($user->account_type === "student") {
            $messagesQuery = Message::where('accepted', 1)->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('section_id', $user->section->id)
                    ->orWhere('type', 1);
            })
                ->latest()
                ->paginate(10);

        } elseif ($user->account_type === "teacher") {
            $messagesQuery = Message::whereAccepted(true)
                ->where(function ($q) use ($user) {
                    $q->where('user_id', $user->id)->orWhere('type', 2);
                })
                ->latest()->paginate(10);
        } elseif ($user->account_type === "Parent") {
            $messagesQuery = Message::whereAccepted(true)
                ->where(function ($q) use ($user) {
                    $q->where('user_id', $user->id)->orWhere('type', 4);
                })
                ->latest()->paginate(10);
        } elseif ($user->account_type === "editor") {
            $messagesQuery = Message::whereAccepted(true)
                ->where(function ($q) use ($user) {
                    $q->where('user_id', $user->id)->orWhere('type', 3);
                })
                ->latest()->paginate(10);
        }
        $unReadMessages = 0;
        $messagesData = $messagesQuery->map(function ($message) use (&$unReadMessages) {
            if ($message->read == 0) {
                $unReadMessages += 1;
            }
            return [
                'id' => $message->id,
                'subject' => $message->subject,
                'message' => $message->message,
                'read' => $message->read,
                'date' => Carbon::create($message->accepted_at)->format('Y/m/d h:i a'),

            ];
        })->toArray();

        $messagesData['unReadMessages'] = $unReadMessages;
        $messagesData['next_page_url'] = $messagesQuery->nextPageUrl();
        $messagesData['previous_page_url'] = $messagesQuery->previousPageUrl();
        return $this->apiResponse($messagesData);
    }

    public function getSentMessages()
    {
        $messagesQuery = Message::whereAccepted(true)
            ->where('sender_id', auth()->id())
            ->latest()->paginate(10);
        $messagesData = $messagesQuery->map(function ($message){
            return [
                'id' => $message->id,
                'subject' => $message->subject,
                'message' => $message->message,
                'read' => $message->read,
                'date' => Carbon::create($message->accepted_at)->format('Y/m/d h:i a'),

            ];
        })->toArray();
        $messagesData['next_page_url'] = $messagesQuery->nextPageUrl();
        $messagesData['previous_page_url'] = $messagesQuery->previousPageUrl();
        return $this->apiResponse($messagesData);

    }

    public function getMessageDetails($id)
    {
        $message = Message::find($id);
        if (!$message)
            return $this->notFound();
        if ($message->read == false)
            $message->update(['read' => true]);
        $messagesData = [
            'id' => $message->id,
            'sender' => $message->sender->name,
            'sender id' => $message->sender_id,
            'reply to message id' => $message->reply_to_message,
            'subject' => $message->subject,
            'message' => $message->message,
            'read' => $message->read,
            'date' => Carbon::create($message->accepted_at)->format('Y/m/d h:i a'),

        ];
        return $this->apiResponse($messagesData);

    }

    public function sendMessageToUser(SendUserMessage $request)
    {

        $data = $request->validated();
        Message::create($data);
        return $this->apiResponse('Message Send Successfully');

    }

    public function replyMessage(ReplyMessage $request)
    {
        $data = $request->validated();
        $replied = Message::where('reply_to_message', $data['reply_to_message'])->exists();
        if ($replied)
            return $this->errorApiResponse('replied', 'You already replied this message');
        $message = Message::find($data['reply_to_message']);
        $user = User::find($message->sender_id);
        $data['user_id'] = $user->id;
        Message::create($data);
        return $this->apiResponse('Message Send Successfully');
    }


}
