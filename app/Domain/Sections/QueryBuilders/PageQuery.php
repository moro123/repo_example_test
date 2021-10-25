<?php 

namespace App\Domain\Sections\QueryBuilders;
use App\Domain\Sections\Models\Page;
use Illuminate\Http\Request;
use Log;

class PageQuery {

    public function getPage(Request $request)
    {
        $name = $request->get('name');

        $page = Page::where('name', $name)
        ->with('main_sections.sections.allChildrenSections')
        ->get();

        return $page;
    }
}
?>