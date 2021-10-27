<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Sections\Services\ProfileService;
use Log;

class ProfileController extends Controller
{
    protected $service;
    protected $CLASS_NAME = "ProfileController: ";

    public function __construct()
    {
        $this->service =  new profileService(); 
    }

    public function getProfiles(Request $request)
    {
        return $this->service->getProfiles($request);
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
        Log::info( "ProfileController" );
        Log::info( $request );
        return $this->service->update( $request, $id );
    }

    public function updateProfile(Request $request)
    {
        return $this->service->updateProfile( $request );
    }



    public function destroy($id)
    {
        return $this->service->destroy( $id );
    }

}