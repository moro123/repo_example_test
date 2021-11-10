<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Event;
use App\Http\Models\Notice;
use App\Http\Models\Front;
use Log;

class EventNoticeController extends Controller {

    public function getEventNotice()
    {
        $events = Event::where('published', 1)->get();
        $notices = Notice::where('published', 1)->get();
        $front = Front::all();

        $data = [
            "events" => $events,
            "notices" => $notices,
            "front" => $front
        ];

        Log::info("EventNoticeController getEventNotice()");
        Log::info( json_encode( $data ) );

        return $data;

    }

}


