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
  

        $name = $request->get('name');
        $front = Front::where('name', $name)->first();

        if ( $front !== null ) {
            $front->delete();
        } 

        $newFront = new Front();
        $newFront->name = $request->get('name');
        $newFront->title = $request->get('title');
        $newFront->header = $request->get('header');

        $path = $request->file('image')->store('public');
        $newFront->image = str_replace("public","storage", $path);
        return $newFront->save();
    }

}
