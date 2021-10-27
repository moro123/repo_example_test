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
        Log::info("getProfiles()");
        $sectionId = $request->get('sectionId');
        $profiles = Profile::where('section_id', $sectionId)->get();

        Log::info( "PROFILES: ". json_encode($profiles) );

        return $profiles;
    }

    public function show($id)
    {
        return Profile::whereId($id)->first();
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
        Log::info( "update()" );
        Log::info( $request->all() );
        Log::info( "id: " . $id );
        $profile = Profile::whereId($id)->first();

        return "";
	}

    public function updateProfile(Request $request)
	{
        Log::info( "ProfileQuery update()" );
        Log::info( $request );
   
        $profile = Profile::whereId( $request->get('id') )->first();
        $profile->name = $request->get('name');
        $profile->title = $request->get('title');
        $profile->description = $request->get('description');

        if ( $request->hasFile('image') ) {
            if ( $profile->image ) {
                try {
					unlink( $profile->image );
				} catch (\Exception $e) {
					Log::info($e);
				}
            } 

            $image = $request->file('image');
            $path = $image->store('public');
            $profile->image = str_replace("public","storage", $path);
        }

        

        return $profile->save();
	}

    public function updateSection(Request $request)
    {  
    }

	public function destroy($id)
	{
        return Profile::where('id', $id)->delete();
	}

}
?>