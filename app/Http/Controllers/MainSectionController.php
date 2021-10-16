<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Sections\Services\MainSectionService;
use Log;

class MainSectionController extends Controller
{
    protected $mainSectionService;
    protected $CLASS_NAME = "MainSectionController: ";

    public function __construct()
    {
        $this->mainSectionService =  new mainSectionService(); 
    }

    public function getMainSection(Request $request)
    {
        return $this->mainSectionService->getMainSection($request);
    }
}