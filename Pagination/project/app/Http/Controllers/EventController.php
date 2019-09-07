<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Calendar;
use App\Event;
class EventController extends Controller
{
	public function index()
    {
        $events = [];
        $data = Event::all();
        if($data->count()) {
            foreach ($data as $key => $value) {
            //predifine Calendar Gengrate by package in the laravel at time of pacakge installation 
                $events[] = Calendar::event(
                    $value->title,
                    true,
                    new \DateTime($value->start_date),
                    new \DateTime($value->end_date.' +1 day'),
                    null,
                    // Add color and link on event
	                [
	                    'color' => 'red',
	                    'url' => 'pass here url and any route',
	                ]


                 );
            }
        }
        $calendar = Calendar::addEvents($events);
        return view('calender_index', compact('calendar'));
    }
    
  
}
