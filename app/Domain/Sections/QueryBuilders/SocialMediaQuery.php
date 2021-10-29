<?php 

namespace App\Domain\Sections\QueryBuilders;
use App\Domain\Sections\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Log;

class SocialMediaQuery {

	protected $CLASS_NAME = "SocialMediaQuery: ";

    public function getSocialMedia(Request $request)
    {
        $profileId = $request->get('profileId');
        $socialMedia = SocialMedia::where('profiles_id', $profileId)->get();
        return $socialMedia;
    }

    public function show($id)
    {
    }

    public function store(Request $request)
	{   
        Log::info( $request );

        $socialMedia = new SocialMedia();
        $socialMedia->name = $request->get('name');
        $socialMedia->link = $request->get('link');
        $socialMedia->profiles_id = $request->get('profileId');

        $icon = $request->file('icon');
        $path = $icon->store('public');
        $socialMedia->icon = str_replace("public","storage", $path);

        return $socialMedia->save();
	}

    public function update(Request $request, $id)
	{
	}

    public function updateSocialMedia(Request $request)
	{
        Log::info( "SocialMediaQuery update()" );
        Log::info( $request );
   
        $socialMedia = SocialMedia::whereId( $request->get('id') )->first();
        $socialMedia->name = $request->get('name');
        $socialMedia->link = $request->get('link');
      
        if ( $request->hasFile('icon') ) {
            if ( $socialMedia->icon ) {
                try {
					unlink( $socialMedia->icon );
				} catch (\Exception $e) {
					Log::info($e);
				}
            } 

            $icon = $request->file('icon');
            $path = $icon->store('public');
            $socialMedia->icon = str_replace("public","storage", $path);
        }

        return $socialMedia->save();
	}

	public function destroy($id)
	{
        return SocialMedia::where('id', $id)->delete();
	}

}
?>