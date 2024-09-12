<?php

namespace App\Http\Controllers\Apis\Calender;

use App\Http\Controllers\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Illuminate\Http\Request;

class CalenderController extends Controller
{
    use ApiResponseTrait;

    public function getEvents()
    {
        $events = Calendar::get()->map(function ($event){
            return[
                'id'=>$event->id,
                'start_at'=>$event->start_at,
                'end_at'=>$event->end_at,
                'color'=>$event->color,
                'description'=>$event->description,
            ];
        })->toArray();

        return $this->apiResponse($events);

    }
}
