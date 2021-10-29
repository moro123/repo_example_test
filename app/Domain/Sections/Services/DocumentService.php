<?php 

namespace App\Domain\Sections\Services;


use App\Domain\Sections\QueryBuilders\DocumentQuery;
use Illuminate\Http\Request;
use Log;

class DocumentService
{
	protected $query;
    protected $CLASS_NAME = "DocumentService: ";

	public function __construct()
    {
        $this->query = new DocumentQuery();
    }

    public function getDocuments(Request $request)
    {
        return $this->query->getDocuments($request);
    }

    public function show($id)
    {
        return $this->query->show($id);
    }

    public function store(Request $request)
	{
		return $this->query->store($request);
	}

    public function updateDocument(Request $request)
	{
		return $this->query->updateDocument($request);
	}

	public function destroy($id)
	{
		return $this->query->destroy($id);
	}
}
?>