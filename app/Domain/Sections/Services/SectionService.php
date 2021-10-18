<?php 

namespace App\Domain\Sections\Services;


use App\Domain\Sections\QueryBuilders\SectionQuery;
use Illuminate\Http\Request;
use Log;

class SectionService
{
	protected $query;
    protected $CLASS_NAME = "SectionService: ";

	public function __construct()
    {
        $this->query = new SectionQuery();
    }



    public function getSections(Request $request)
    {
        return $this->query->getSections($request);
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

	public function destroy($id)
	{
		return $this->query->destroy($id);
	}
}
?>