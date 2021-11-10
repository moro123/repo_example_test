<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Post;
use Log;

class PostController extends Controller
{

    public function index()
    {
        Log::info("index()");   
        $posts = Post::where('published', 1)->get();

        Log::info( "posts: " . json_encode( $posts ) );

        return $posts;
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }

 
    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }

    public function storeFiles(Request $request)
    {
        Log::info("storeFiles()");
        Log::info( $request );
    }
}
