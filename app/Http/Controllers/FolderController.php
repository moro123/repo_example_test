<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Sections\Services\FolderService;
use Log;

class FolderController extends Controller
{
    protected $service;
    protected $CLASS_NAME = "FolderController: ";

    public function __construct()
    {
        $this->service =  new FolderService(); 
    }

    public function getFolders(Request $request)
    {
        return $this->service->getFolders($request);
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

    public function updateFolder(Request $request)
    {
        return $this->service->updateFolder( $request );
    }

    public function destroy($id)
    {

        return $this->service->destroy( $id );
    }

}