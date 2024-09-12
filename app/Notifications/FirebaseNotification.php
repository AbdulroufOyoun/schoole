<?php

namespace App\Notifications;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Facades\Larafirebase;


class FirebaseNotification extends Notification
{
    use Queueable;
    protected $tokens, $message, $users_ids,$logo;

    public function __construct(array $tokens, array $message,array $users_ids)
    {
        $this->tokens = $tokens;
        $this->message = $message;
        $this->users_ids = $users_ids;
        // add image to data array
        $logo = Setting::first()->light_logo;
        $this->message['icon'] = asset($logo);
    }

    public function via($notifiable)
    {
        return ['firebase'];
    }

    public function toFireBase($notifiable)
    {
        // store the notifictions
        foreach ($this->users_ids as $user_id) {

            \App\Models\Notification::create([
                'title'=>$this->message['title'],
                'body'=>$this->message['body'],
                'type'=>$this->message['type'],
                'url'=>$this->message['url'],
                'user_id'=>$user_id,
            ]);
        }


        // send the message to the devices
        $response = LaraFirebase::
            withTitle($this->message['title'])
            ->withBody($this->message['body'])
            ->withIcon($this->message['icon'])
            ->withSound('default')
            ->withAdditionalData([
                'color' => '#ffcc33',
                'badge' => 0,
            ])
            ->sendNotification($this->tokens);
        // if ($response['success'] == 1) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

}
