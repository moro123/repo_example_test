<?php 

namespace App\Domain\Sections\Services;


use App\Domain\Sections\QueryBuilders\SocialMediaQuery;
use Illuminate\Http\Request;
use Log;

class SocialMediaService
{
	protected $query;
    protected $CLASS_NAME = "SocialMediaService: ";

	public function __construct()
    {
        $this->query = new SocialMediaQuery();
    }

    public function getSocialMedia(Request $request)
    {
        return $this->query->getSocialMedia($request);
    }

    public function show($id)
    {
        return $this->query->show($id);
    }

    public function store(Request $request)
	{
		return $this->query->store($request);
	}

    public function update(Request $request, $id)
	{
		return $this->query->update($request, $id);
	}

    public function updateSocialMedia(Request $request)
	{
		return $this->query->updateSocialMedia($request);
	}

	public function destroy($id)
	{
		return $this->query->destroy($id);
	}
}
?>