<?php
use Vinelab\Http\Client as HttpClient;

class TradetransactionController extends \BaseController
{
    /**
     * Display a listing of the tradetransactions.
     * @return View tradetransactions.index with all tradetransactions
     */
    public function index()
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/tradetransactions", 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $tradetransactions 	= $response->json();
        return View::make( 'tradetransactions.index', [ "tradetransactions" => $tradetransactions ] );
    }

    /**
     * Display the specified tradetransaction.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // Todo
    }
    /**
     * Show the form for creating a new tradetransaction.
     * @return View tradetransactions.form with tradetransaction null
     */
    public function create()
    {
        $tradetransaction = null;
        return View::make( 'tradetransactions.form', [ 'tradetransaction' => $tradetransaction ] );
    }
    /**
     * Show the form for editing the specified tradetransaction.
     * @param  int  $id
     * @return View tradetransactions.form with tradetransaction
     */
    public function edit($id)
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/tradetransactions/" . $id, 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $tradetransaction 		= $response->json();
        return View::make( 'tradetransactions.form', [ 'tradetransaction' => $tradetransaction ] );
    }
    /**
     * Store a newly created tradetransaction in storage.
     * Object structure for HTTP POST
     * $tradetransaction = [
     * 			"createdAt" 			=> [timestamp],
     * 			"updatedAt" 			=> [timestamp],
     * 			"transaction_date" 		=> [timestamp],
     * 			"value" 				=> [float],
     * 			"notes" 				=> [string]
     * 		];
     * @return Response
     */
    public function store()
    {
        $inputs 	= Input::except( '_token' );
        // Refactored in BeeTools Model
        $response 	= BeeTools::entity_store( $inputs, 'tradetransactions' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'tradetransactions' );
    }
    /**
     * Update the specified tradetransaction in storage.
     * Object structure for HTTP PUT
     * $tradetransaction = [
     * 			"id" 					=> [integer][notnull],
     * 			"createdAt" 			=> [timestamp],
     * 			"updatedAt" 			=> [timestamp],
     * 			"transaction_date" 		=> [timestamp],
     * 			"value" 				=> [float],
     * 			"notes" 				=> [string]
     * 		];
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $tradetransaction 			= Input::except( '_token' );
        $tradetransaction[ 'id' ]	= (int) $id;
        // Refactored in BeeTools Model
        $response 		= BeeTools::entity_update( $tradetransaction, 'tradetransactions' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'tradetransactions' );
    }
    /**
     * Remove the specified tradetransaction from storage.
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        // Refactored in BeeTools Model
        $response 	= BeeTools::entity_delete( $id, 'tradetransactions' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'tradetransactions' );
    }

}
