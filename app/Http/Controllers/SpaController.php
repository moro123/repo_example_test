<?php

namespace App\Http\Controllers;

use Auth;
use Log;

class SpaController extends Controller
{
    public function index()
    {
        // $user = Auth::user();
        
        // Log::info( "user: " . json_encode( $user ) );
        // $sessionAccess = session('access');
        // Log::info("spa session access: " . json_encode( $sessionAccess ) );

        return view('spa');
    }
}



