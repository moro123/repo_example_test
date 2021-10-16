<?php 

namespace App\Domain\Sections\QueryBuilders;
use App\Domain\Sections\Models\MainSection;
use App\Domain\Sections\Models\Section;
use Illuminate\Http\Request;
use Log;

class SectionQuery {

	protected $CLASS_NAME = "SectionQuery: ";

    public function getSections(Request $request)
    {

        if ( $request->has('mainSection') ) {
            $mainSection = $request->get('mainSection');
            $sections = Section::where('main_section_id', $mainSection['id'] )->get();

            return $sections;
        }
        
        
    }

    public function show($id)
    {
    }

    public function store(Request $request)
	{
        Log::info( $request );
        return "SectionQuery store";
	}

    public function update(Request $request, $id)
	{
	}

	public function delete($id)
	{
	}

}
?>