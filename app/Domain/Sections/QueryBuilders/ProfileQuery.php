<?php 

namespace App\Domain\Sections\QueryBuilders;
use App\Domain\Sections\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Log;

class ProfileQuery {

	protected $CLASS_NAME = "ProfileQuery: ";

    public function getProfiles(Request $request)
    {
        $sectionId = $request->get('sectionId');
        return  Profile::where('section_id', $sectionId)->get();
    }

    public function show($id)
    {
    }

    public function store(Request $request)
	{   
        Log::info( "ProfileQuery store()" );
        Log::info( $request );
        $profile = $request->all();
    
        $newProfile = new Profile();
        $newProfile->name = $profile['name'];
        $newProfile->title = $profile['title'];
        $newProfile->description = $profile['description'];
        $newProfile->section_id = $profile['sectionId'];

        $image = $request->file('image');
        $path = $image->store('public');
        $newProfile->image = str_replace("public","storage", $path);
       
        
        return $newProfile->save();;
	}

    public function update(Request $request, $id)
	{  
	}

    public function updateSection(Request $request)
    {  
    }

	public function destroy($id)
	{
	}

}
?>