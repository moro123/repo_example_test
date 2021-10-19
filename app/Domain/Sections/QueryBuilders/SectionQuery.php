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
        Log::info("SectionQuery update()");
        Log::info( $request );
        if ( $request->has('item') ) {
            $name = $request->get('item')['name'];

            $section = Section::where('id', $id)->first();
            $section->name = $name;

            return $section->save();
        }

        


        


	}

    public function updateSection(Request $request)
    {
        $section = $request->all();

        $oldImage = Section::whereId( $section['id'] )->first()->image;
        $oldVideo = Section::whereId( $section['id'] )->first()->video;

        Section::whereId( $section['id'] )->update( $section );

        $sectionUpdated = Section::find( $section['id'] );

      
        if ( $request->hasFile('image') ) {
            if ( $oldImage ) {
                try {
					unlink( $oldImage );
				} catch (\Exception $e) {
					Log::info($e);
				}
            } 
    
            $path = $section['image']->store('public');
            $sectionUpdated->image = str_replace("public","storage", $path);
            $sectionUpdated->save();
        }

        if ( $request->hasFile('video') ) {

            if ( $oldVideo ) {
                try {
					unlink( $oldVideo );
				} catch (\Exception $e) {
					Log::info($e);
				}
            } 

            $path = $section['video']->store('public');
            $sectionUpdated->video = str_replace("public","storage", $path);
            $sectionUpdated->save();
        }

        return $sectionUpdated;
    }



	public function destroy($id)
	{
        return Section::where('id', $id)->delete();
	}

}
?>