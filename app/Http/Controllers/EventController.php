<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Event;
use App\Http\Models\Contact;
use Log;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where('published', 1)->get();

        return $events;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  
        Log::info("store()");
        Log::info( $request );

        $event = new Event();
        $event->title = $request->get('title');
        $event->date = $request->get('date');
        $event->subtitle = $request->get('subtitle');
        $event->content = $request->get('content');
        $event->published = $request->get('published');
        $event->source = $request->get('source');

        $imagePath = $request->file('image')->store('public');
        $event->image = str_replace("public","storage", $imagePath);

        $filePath = $request->file('file')->store('public');
        $event->file = str_replace("public","storage", $filePath);
        
        $status = $event->save();

        $contact1 = new Contact();
        $contact1->title = $request->get('contact1')['title'];
        $contact1->name = $request->get('contact1')['name'];
        $contact1->phone = $request->get('contact1')['phone'];
        $contact1->email = $request->get('contact1')['email'];
        $contact1->event_id = $event->id;
        $contact1->save();

        $contact2 = new Contact();
        $contact2->title = $request->get('contact2')['title'];
        $contact2->name = $request->get('contact2')['name'];
        $contact2->phone = $request->get('contact2')['phone'];
        $contact2->email = $request->get('contact2')['email'];
        $contact2->event_id = $event->id;
        $contact2->save();
        

        return $status;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::where('id', $id)
        ->with(['contacts'])
        ->get()
        ->first();

        return $event;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $oldImage = $request->get('oldImage');
        $oldFile = $request->get('oldFile');

        $event = Event::where( 'id', $id )->get()->first();
        $event->title = $request->get('title');
        $event->subtitle = $request->get('subtitle');
        $event->content = $request->get('content');
        $event->date = $request->get('date');
        $event->source = $request->get('source');
        $event->published = $request->get('published');
        $status = $event->save();

        if ( $request->hasFile('image') ) {
            if ( $oldImage ) {
                try {
					unlink( $oldImage );
				} catch (\Exception $e) {
					Log::info($e);
				}
            } 
    
            $path = $request->file('image')->store('public');
            $event->image = str_replace("public","storage", $path);
            $event->save();
        }

        if ( $request->hasFile('file') ) {

            if ( $oldFile ) {
                try {
					unlink( $oldFile );
				} catch (\Exception $e) {
					Log::info($e);
				}
            } 

            $path = $request->file('file')->store('public');
            $event->file = str_replace("public","storage", $path);
            $event->save();
        }

        return $status;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contact::where('event_id', $id)->delete();
        return Event::where( 'id', $id )->delete();
    }
}
