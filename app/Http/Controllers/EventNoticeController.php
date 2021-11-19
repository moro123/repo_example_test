<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Event;
use App\Http\Models\Notice;
use App\Http\Models\Front;
use Log;
use Carbon\Carbon;

class EventNoticeController extends Controller {

    public function getFront() {
        return Front::all();
    }

    public function getNoticeFilter() {
        $years = Notice::selectRaw('year(date) year')
        ->where('published', 1)
        ->groupBy('year')
        ->get();

        $yearsArray = [];
        foreach ($years as $key => $item) {
            array_push( $yearsArray, $item->year );
        }

        return $yearsArray;
    }

    public function checkYear($array, $string)
    {
        foreach ($array as $item) {
            if (strpos($string, $item) !== FALSE) { 
                return true;
            }
        }
    
        return false;
    }

    public function getEventFilter() {
        
        $events = Event::select('date')
        ->where('published', 1)
        ->whereDay('date', '<=', Carbon::now() )
        ->groupBy('date')
        ->orderBy('date', 'DESC')
        ->get();

        $years = [];
        foreach ($events as $key => $item) {
            $year = Carbon::createFromFormat('Y-m-d', $item->date)->year;
            array_push( $years, $year  );
        }

        return $years;
    }

    public function getNotices(Request $request)
    {
        $year = $request->get('year');
        
        if ( $year === null ) {
            $year = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now())->year;
        }
        
        $notices = Notice::where('published', 1)
        ->whereYear('date', $year)
        ->get();
      
        return $notices;
    }

    public function getEvents() 
    {
        $nextEvents = Event::where('published', 1)
        ->whereDay('date', '>', Carbon::now() )
        ->orderBy('date')
        ->take(2)
        ->get();

        $lastEvents = Event::where('published', 1)
        ->whereDay('date', '<=', Carbon::now() )
        ->take(2)
        ->get();

        $data = [
            'nextEvents' => $nextEvents,
            'lastEvents' => $lastEvents
        ];

        return $data;
    }

 
    public function getEventsByYear(Request $request)
    {
        $year = $request->get('year');

        if ( $year === null ) {
            $year = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now())->year;
        } 
        
        $events = Event::where('published', 1)
        ->whereDay('date', '<=', Carbon::now() )
        ->whereYear('date', $year)
        ->get();
      
        return $events;
    }

    public function getNotice(Request $request) 
    {
        $id = $request->get('id');
        $notice = Notice::where('id', $id)
        ->with(['contacts'])
        ->get()
        ->first();

        return $notice;
    }

    public function getEvent(Request $request) 
    {
        $id = $request->get('id');
        $event= Event::where('id', $id)
        ->with(['contacts'])
        ->get()
        ->first();

        return $event;
    }



}


