<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Sections\Services\PageService;
use Log;

class PageController extends Controller
{
    protected $pageService;

    public function __construct()
    {
        $this->pageService =  new pageService(); 
    }

    public function getPage(Request $request)
    {
        return $this->pageService->getPage($request);
    }

}