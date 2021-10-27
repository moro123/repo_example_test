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
        return $this->CLASS_NAME + "getSocialMedia";
    }

    public function show($id)
    {
    }

    public function store(Request $request)
	{   
	}

    public function update(Request $request, $id)
	{
	}

    public function updateSocialMedia(Request $request)
	{
	}

	public function destroy($id)
	{
	}

}
?>