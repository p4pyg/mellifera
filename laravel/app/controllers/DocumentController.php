<?php
use Vinelab\Http\Client as HttpClient;

class DocumentController extends BaseController
{
    /**
     * Display documents list
     * @return  View documents.index with all documents
     */
    public function index()
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [
                                        'url' => Config::get( 'app.api' ) . "atomic/files",
                                        'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                    ] );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
        $documents 		= $response->json();

        return View::make( 'documents.index', [ "documents" => $documents ] );
    }
    /**
     * Display the specified document.
     *
     * @param  int  $index
     * @return Response
     */
    public function show($index)
    {
        // Todo
    }
    /**
     * Show the form for creating a new document.
     * @return View documents.form with document null
     */
    public function create()
    {
        $document = null;
        return View::make( 'documents.form', [ 'document' => $document ] );
    }
    /**
     * Show the form for editing the specified document.
     * @param  int  $index
     * @return View documents.form with document
     */
    public function edit($index)
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [
                                        'url' => Config::get( 'app.api' ) . "atomic/files/" . $index,
                                        'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                    ] );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
        $document 		= $response->json();
        return View::make( 'documents.form', [ 'document' => $document ] );
    }
    /**
     * Store a newly created document in storage.
     * Object structure for HTTP POST
     * $document = [
     * 	"createdAt" => [timestamp],
     * 	"updatedAt" => [timestamp],
     * 	"document_name" => [string],
     * 	"document_type" => [string],
     * 	"url" 		=> [string],
     * 	"notes" 	=> [string]
     * 	];
     * @return Response
     */
    public function store()
    {
        $inputs 	= Input::except( '_token' );
        // Refactored in BeeTools Model
        $response 	= BeeTools::entityStore( $inputs, 'documents' );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'documents' );
    }
    /**
     * Update the specified document in storage.
     * Object structure for HTTP PUT
     * $document = [
     * 	"id" 		=> [integer][notnull],
     * 	"createdAt" => [timestamp],
     * 	"updatedAt" => [timestamp],
     * 	"document_name" => [string],
     * 	"document_type" => [string],
     * 	"url" 		=> [string],
     * 	"notes" 	=> [string]
     * 	];
     * @param  int  $index
     * @return Response
     */
    public function update($index)
    {
        $document 			= Input::except( '_token' );
        $document[ 'id' ] 	= (int) $index;
        // Refactored in BeeTools Model
        $response 		= BeeTools::entityUpdate( $document, 'documents' );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'documents' );
    }
    /**
     * Remove the specified document from storage.
     * @param  int  $index
     * @return Response
     */
    public function delete($index)
    {
        BeeTools::entityDelete( $index, 'documents' );
        return Redirect::to( 'documents' );
    }
}
