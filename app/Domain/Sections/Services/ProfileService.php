<?php 

namespace App\Domain\Sections\Services;


use App\Domain\Sections\QueryBuilders\ProfileQuery;
use Illuminate\Http\Request;
use Log;

class ProfileService
{
	protected $query;
    protected $CLASS_NAME = "ProfileService: ";

	public function __construct()
    {
        $this->query = new ProfileQuery();
    }

    public function getProfiles(Request $request)
    {
        return $this->query->getProfiles($request);
    }

    public function show($id)
    {
        return $this->query->show($id);
    }

    public function store(Request $request)
	{
        Log::info("ProfileService store()");
		return $this->query->store($request);
	}

    public function update(Request $request, $id)
	{
		return $this->query->update($request, $id);
	}

	public function destroy($id)
	{
		return $this->query->destroy($id);
	}
}
?>