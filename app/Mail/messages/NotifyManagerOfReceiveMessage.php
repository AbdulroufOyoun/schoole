<?php

namespace App\Mail\messages;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyManagerOfReceiveMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $url;

    public function __construct($message)
    {
        $this->message = $message;
        if ($this->message->type == "academic")
            $this->url = route('messages.get-academic-messages');
        elseif ($this->message->type == "admin")
            $this->url = route('messages.get-admin-messages');
    }

    public function build()
    {
        return $this->markdown('mail/messages/notifyManager')
            ->subject('New Message Received');
    }
}
