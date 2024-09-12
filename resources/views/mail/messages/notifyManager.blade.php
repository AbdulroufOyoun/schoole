@component('mail::message')
    A new message has been received from : {{$message->sender->name}}
    <br>
    subject : {{$message->subject}}
    <br>
    message : {{$message->message}}

@component('mail::button', ['url' => $url])
view in Dashboard
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
