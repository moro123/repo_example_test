<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Sections\Services\SocialMediaService;
use Log;

class SocialMediaController extends Controller
{
    protected $service;
    protected $CLASS_NAME = "SocialMediaController: ";

    public function __construct()
    {
        $this->service =  new SocialMediaService(); 
    }

    public function getSocialMedia(Request $request)
    {
        return $this->service->getSocialMedia($request);
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function edit($id)
    {      
    }

    public function update(Request $request, $id)
    {
        return $this->service->update( $request, $id );
    }

    public function updateSocialMedia(Request $request)
    {
        
        return $this->service->updateSocialMedia( $request );
    }

    public function destroy($id)
    {
        return $this->service->destroy( $id );
    }

}