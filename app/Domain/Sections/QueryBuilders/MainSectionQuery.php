<?php 

namespace App\Domain\Sections\QueryBuilders;
use App\Domain\Sections\Models\MainSection;
use Illuminate\Http\Request;
use Log;

class MainSectionQuery {

	protected $CLASS_NAME = "MainSectionQuery: ";

    public function getMainSection(Request $request)
    {
        $mainSection = MainSection::where('name', $request->name)->first();
        return $mainSection;
    }



}
?>