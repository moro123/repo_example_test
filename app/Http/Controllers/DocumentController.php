<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Sections\Services\DocumentService;
use Log;

class DocumentController extends Controller
{
    protected $service;
    protected $CLASS_NAME = "DocumentController: ";

    public function __construct()
    {
        $this->service =  new DocumentService(); 
    }

    public function getDocuments(Request $request)
    {
        return $this->service->getDocuments($request);
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

    public function updateDocument(Request $request)
    {
        return $this->service->updateDocument( $request );
    }

    public function destroy($id)
    {
        return $this->service->destroy( $id );
    }

}