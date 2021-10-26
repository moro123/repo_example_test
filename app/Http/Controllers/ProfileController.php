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
        Log::info("ProfileController store()");
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

    public function destroy($id)
    {
        return $this->service->destroy( $id );
    }

}