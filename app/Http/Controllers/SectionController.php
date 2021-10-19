<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Sections\Services\SectionService;
use Log;

class SectionController extends Controller
{
    protected $sectionService;
    protected $CLASS_NAME = "SectionController: ";

    public function __construct()
    {
        $this->sectionService =  new sectionService(); 
    }

    public function index()
    {
        return "index post";
    }

    public function getSections(Request $request)
    {
        return $this->sectionService->getSections($request);
    }

    public function store(Request $request)
    {
        return $this->sectionService->store($request);
    }

    public function show($id)
    {
        return $this->sectionService->show($id);
    }

    public function edit($id)
    {      
    }

    public function update(Request $request, $id)
    {
        return $this->sectionService->update( $request, $id );
    }

    public function updateSection(Request $request)
    {
        return $this->sectionService->updateSection( $request);
    }



    public function destroy($id)
    {
        return $this->sectionService->destroy( $id );
    }
}