<?php 

namespace App\Domain\Sections\Services;


use App\Domain\Sections\QueryBuilders\FolderQuery;
use Illuminate\Http\Request;
use Log;

class FolderService
{
	protected $query;
    protected $CLASS_NAME = "FolderService: ";

	public function __construct()
    {
        $this->query = new FolderQuery();
    }

    public function getFolders(Request $request)
    {
        return $this->query->getFolders($request);
    }

    public function show($id)
    {
        return $this->query->show($id);
    }

    public function store(Request $request)
	{
		return $this->query->store($request);
	}

    public function updateFolder(Request $request)
	{
		return $this->query->updateFolder($request);
	}


	public function destroy($id)
	{
		return $this->query->destroy($id);
	}
}
?>