<?php 

namespace App\Domain\Pages\Services;


use App\Domain\Sections\QueryBuilders\PageQuery;
use Illuminate\Http\Request;
use Log;

class PageService
{
	protected $query;

	public function __construct()
    {
        $this->query = new PageQuery();
    }

    public function getPage(Request $request)
    {
        return $this->query->getPage($request);
    }
}
?>