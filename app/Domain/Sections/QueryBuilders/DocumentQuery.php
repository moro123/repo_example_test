<?php 

namespace App\Domain\Sections\QueryBuilders;
use App\Domain\Sections\Models\Document;
use Illuminate\Http\Request;
use Log;

class DocumentQuery {

	protected $CLASS_NAME = "DocumentQuery: ";

    public function getDocuments(Request $request)
    {
        Log::info( "DocumentQuery: getDocuments()" );
        Log::info( $request );

        $folderId = $request->get( 'folderId' );
        $documents = Document::where('folder_id', $folderId)->get();

        return $documents;
    }

    public function show($id)
    {
    }

    public function store(Request $request)
	{
        Log::info( "DocumentQuery: store()" );
        Log::info( $request );

        $document = new Document();
        $document->name = $request->get('name');
        $document->folder_id = $request->get('folderId');

        $link = $request->file('link');
        $path = $link->store('public');
        $document->link = str_replace("public","storage", $path);

        return $document->save();
	}

    public function updateDocument(Request $request)
	{
        Log::info( "DocumentQuery: updateDocument()" );
        Log::info( $request );

        $document = Document::whereId( $request->get('id') )->first();
        $document->name = $request->get('name');

        if ( $request->hasFile('link') ) {
            if ( $document->link ) {
                try {
					unlink( $document->link );
				} catch (\Exception $e) {
					Log::info($e);
				}
            } 

            $link = $request->file('link');
            $path = $link->store('public');
            $document->link = str_replace("public","storage", $path);
        }

        return $document->save();
	}


	public function destroy($id)
	{
        Log::info( "DocumentQuery: destroy()" );
        Log::info( $id );

        return Document::where('id', $id)->delete();
	}

}
?>