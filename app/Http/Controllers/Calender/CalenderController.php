<?php

namespace App\Http\Controllers\Calender;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalenderRequest\StoreEventRequest;
use App\Models\Calendar;
use App\Models\User;
use App\Notifications\FirebaseNotification;
use Carbon\Carbon;
use Faker\Provider\Color;
use Illuminate\Http\Request;

class CalenderController extends Controller
{

    public function index()
    {
        $events = Calendar::get();
        return view('admin_panel.calender.index',compact('events'));
    }

    public function create()
    {
        return view('admin_panel.calender.create');
    }

    public function store(StoreEventRequest $request)
    {
        $date = $request->validated();
        $rgbValues  = $this->hsvToRgb($request->color);
        $red = $rgbValues[0];
        $green = $rgbValues[1];
        $blue = $rgbValues[2];
        $color = "rgb($red, $green, $blue)";
        $date['color'] = $color;
        Calendar::create($date);

        #send notifications to all users
        $users = User::where('school_id',auth()->user()->school_id)->get();
        $fcm_tokens = [];
        $users_ids = [];
        foreach ($users as $user) {
            $fcm_tokens[] = $user->fcm_token;
            $users_ids[] = $user->id;
        }

        $message = [
            'title' => 'A new event has been added ',
            'body' => 'You can view in the calendar on the day ' . Carbon::create($date['start_at'])->format('y/m/d'),
            'type' => 'calendar',
            'url' => url('api/calendar'),
        ];
        \Notification::send(null, new FirebaseNotification($fcm_tokens, $message, $users_ids));


        $request->session()->flash('success',__('alert.alert_saved'));
        return redirect()->back();
    }


    public function delete(Request $request)
    {
        $request->validate(['id'=>['required','exists:calendars,id']]);
        Calendar::find($request->id)->delete();
        $request->session()->flash('success',__('alert.alert_delete'));
        return redirect()->back();

    }

    function hsvToRgb($color)
    {
        // Remove the "hsv(" and ")" from the color string
        $color = str_replace(array('hsv(', ')'), '', $color);

        // Split the HSV values
        $values = explode(',', $color);

        // Extract the individual HSV components
        $hue = intval($values[0]);
        $saturation = intval($values[1]);
        $value = intval($values[2]);

        // Convert HSV values to the range 0-1
        $h = $hue / 360;
        $s = $saturation / 100;
        $v = $value / 100;

        // Calculate RGB values
        $r = $g = $b = 0;

        if ($s == 0) {
            $r = $g = $b = $v;
        } else {
            $h *= 6; // Scale hue to the range 0-6
            $i = floor($h);
            $f = $h - $i;
            $p = $v * (1 - $s);
            $q = $v * (1 - ($s * $f));
            $t = $v * (1 - ($s * (1 - $f)));

            switch ($i) {
                case 0:
                    $r = $v;
                    $g = $t;
                    $b = $p;
                    break;
                case 1:
                    $r = $q;
                    $g = $v;
                    $b = $p;
                    break;
                case 2:
                    $r = $p;
                    $g = $v;
                    $b = $t;
                    break;
                case 3:
                    $r = $p;
                    $g = $q;
                    $b = $v;
                    break;
                case 4:
                    $r = $t;
                    $g = $p;
                    $b = $v;
                    break;
                default:
                    $r = $v;
                    $g = $p;
                    $b = $q;
                    break;
            }
        }

        // Scale RGB values to 0-255 range
        $red = round($r * 255);
        $green = round($g * 255);
        $blue = round($b * 255);

        // Return the RGB values as an array
        return [$red, $green, $blue];
    }




}
