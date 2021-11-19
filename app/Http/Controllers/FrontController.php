<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Front;
use Log;

class FrontController extends Controller
{

    public function showFront(Request $request)
    {
        Log::info("showFront()");
        Log::info( $request );

        $front = Front::where('name', $request->get('name'))->first();

        return $front;
    }

    public function storeFront(Request $request)
    {
        Log::info("storeFront");
        Log::info( $request );

        $id = $request->get('id');
        $name = $request->get('name');
        $status;

        if ( (int) $id === -1 ) {
            $newFront = new Front();
            $newFront->name = $request->get('name');
            $newFront->title = $request->get('title');
            $newFront->header = $request->get('header');

            $path = $request->file('image')->store('public');
            $newFront->image = str_replace("public","storage", $path);
            $status = $newFront->save();
        } else {
            $front = Front::where('name', $name)->first();
            $front->name = $request->get('name');
            $front->title = $request->get('title');
            $front->header = $request->get('header');

            if ( $request->file('image') ) {
                $path = $request->file('image')->store('public');
                $front->image = str_replace("public","storage", $path);
                
            }
            $status = $front->save();
        }

        return $status;
    }

}
