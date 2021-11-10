<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Notice;
use App\Http\Models\Contact;
use Log;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::where('published', 1)->get();

        return $notices;
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        Log::info("NoticeController");
        Log::info("store()");
        Log::info( $request );

        $notice = new Notice();
        $notice->title = $request->get('title');
        $notice->date = $request->get('date');
        $notice->subtitle = $request->get('subtitle');
        $notice->content = $request->get('content');
        $notice->published = $request->get('published');
        $notice->source = $request->get('source');

        $imagePath = $request->file('image')->store('public');
        $notice->image = str_replace("public","storage", $imagePath);

        $filePath = $request->file('file')->store('public');
        $notice->file = str_replace("public","storage", $filePath);
        
        $status = $notice->save();

        

        $contact1 = new Contact();
        $contact1->title = $request->get('contact1')['title'];
        $contact1->name = $request->get('contact1')['name'];
        $contact1->phone = $request->get('contact1')['phone'];
        $contact1->email = $request->get('contact1')['email'];
        $contact1->notice_id = $notice->id;
        $contact1->save();

        $contact2 = new Contact();
        $contact2->title = $request->get('contact2')['title'];
        $contact2->name = $request->get('contact2')['name'];
        $contact2->phone = $request->get('contact2')['phone'];
        $contact2->email = $request->get('contact2')['email'];
        $contact2->notice_id = $notice->id;
        $contact2->save();
        

        return $status;
    }

    public function show($id)
    {
        $notice = Notice::where('id', $id)
        ->with(['contacts'])
        ->get()
        ->first();

        Log::info("show(): " . $id );
        Log::info( json_encode( $notice ) );

        return $notice;
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $oldImage = $request->get('oldImage');
        $oldFile = $request->get('oldFile');

        $notice = Notice::where( 'id', $id )->get()->first();
        $notice->title = $request->get('title');
        $notice->subtitle = $request->get('subtitle');
        $notice->content = $request->get('content');
        $notice->date = $request->get('date');
        $notice->source = $request->get('source');
        $notice->published = $request->get('published');
        $status = $notice->save();

        if ( $request->hasFile('image') ) {
            if ( $oldImage ) {
                try {
					unlink( $oldImage );
				} catch (\Exception $e) {
					Log::info($e);
				}
            } 
    
            $path = $request->file('image')->store('public');
            $notice->image = str_replace("public","storage", $path);
            $notice->save();
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
            $notice->file = str_replace("public","storage", $path);
            $notice->save();
        }

        return $status;
    }

    public function destroy($id)
    {
        Contact::where('notice_id', $id)->delete();
        return Notice::where( 'id', $id )->delete();
    }

    public function getNoticesByYear(Request $request)
    {
        $year = $request->get('year');

        

        return $request;
    }

}
