<?php

namespace App\Services;

use App\Models\Setting;
use Kutia\Larafirebase\Facades\Larafirebase;

class FirebaseNotificationService
{

    public function sendNotification(array $tokens, array $message)
    {


        $logo = Setting::first()->light_logo;
        $message['icon'] = asset($logo);

        // send the message to the devices

        $response = LaraFirebase::
            withTitle($message['title'])
            ->withBody($message['body'])
            ->withIcon($message['icon'])
            ->withSound('default')
            ->sendNotification($tokens);


        // check if the notification was sent successfully
        if ($response['success'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}
