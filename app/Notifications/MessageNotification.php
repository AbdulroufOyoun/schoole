<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\Setting;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Facades\Larafirebase;

class MessageNotification extends Notification
{
    use Queueable;

    protected $tokens, $message, $users_ids, $logo;

    public function __construct(array $tokens, array $message)
    {
        $this->tokens = $tokens;
        $this->message = $message;
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
        // send the message by notification
        LaraFirebase::withTitle($this->message['subject'])
            ->withBody($this->message['message'])
            ->withIcon($this->message['icon'])
            ->withSound('default')
            ->withAdditionalData([
                'color' => '#ffcc33',
                'badge' => 0,
            ])
            ->sendNotification($this->tokens);
    }

}
