<?php 

namespace App\Domain\Sections\Services;


use App\Domain\Sections\QueryBuilders\MainSectionQuery;
use Illuminate\Http\Request;
use Log;

class MainSectionService
{
	protected $query;
    protected $CLASS_NAME = "MainSectionService: ";

	public function __construct()
    {
        $this->query = new MainSectionQuery();
    }

    public function getMainSection(Request $request)
    {
        return $this->query->getMainSection($request);
    }

}
?>