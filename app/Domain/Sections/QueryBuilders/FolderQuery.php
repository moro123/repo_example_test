<?php 

namespace App\Domain\Sections\QueryBuilders;
use App\Domain\Sections\Models\Folder;
use Illuminate\Http\Request;
use Log;

class FolderQuery {

	protected $CLASS_NAME = "FolderQuery: ";

    public function getFolders(Request $request)
    {
        Log::info( "FolderQuery getfolders()" );
        Log::info( $request );

        $sectionId = $request->get( 'sectionId' );
        $folders = Folder::where('section_id', $sectionId)->get();

        return $folders;
    }

    public function show($id)
    {
    }

    public function store(Request $request)
	{
        $folder = new Folder();
        $folder->name = $request->get('name');
        $folder->section_id = $request->get('sectionId');


        return $folder->save();
	}

    public function updateFolder(Request $request)
	{
        $folder = Folder::whereId( $request->get('id') )->first();
        $folder->name = $request->get('name');

        return $folder->save();
	}


	public function destroy($id)
	{
        return Folder::where('id', $id)->delete();
	}

}
?>