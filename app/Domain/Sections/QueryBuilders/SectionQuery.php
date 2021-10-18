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
        Log::info("SectionQuery show() " . $id);
        $section = Section::find($id);
        return $section;
    }

    public function store(Request $request)
	{
        if ( $request->has('mainSection') ) {
            $mainSection = $request->get('mainSection');
            $name = $request->get('item')['name'];

            $section = new Section();
            $section->main_section_id = $mainSection['id'];
            $section->name = $name;

            return $section->save();
        }
	}

    public function update(Request $request, $id)
	{
        $name = $request->get('item')['name'];

        $section = Section::where('id', $id)->first();
        $section->name = $name;

        return $section->save();
	}

	public function destroy($id)
	{
        return Section::where('id', $id)->delete();
	}

}
?>