<?php
use Vinelab\Http\Client as HttpClient;

class HoneysuperController extends \BaseController
{
    /**
     * Display a listing of the honeysupers.
     * @return View honeysupers.index with all honeysupers
     */
    public function index()
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [
                                    'url' => Config::get( 'app.api' ) . "atomic/honeysupers",
                                    'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                    ] );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $honeysupers 	= $response->json();
        return View::make( 'honeysupers.index', [ "honeysupers" => $honeysupers ] );
    }

    /**
     * Display the specified honeysuper.
     *
     * @param  int  $index
     * @return Response
     */
    public function show($index)
    {
        // Todo
    }
    /**
     * Show the form for creating a new honeysuper.
     * @return View honeysupers.form with honeysuper null
     */
    public function create()
    {
        $honeysuper = null;
        return View::make( 'honeysupers.form', [ 'honeysuper' => $honeysuper ] );
    }
    /**
     * Show the form for editing the specified honeysuper.
     * @param  int  $index
     * @return View honeysupers.form with honeysuper
     */
    public function edit($index)
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [
                                    'url'       => Config::get( 'app.api' ) . "atomic/honeysupers/" . $index ,
                                    'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                    ] );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $honeysuper 		= $response->json();
        return View::make( 'honeysupers.form', [ 'honeysuper' => $honeysuper ] );
    }
    /**
     * Store a newly created honeysuper in storage.
     * Object structure for HTTP POST
     * $honeysuper = [
     * 			"createdAt" 			=> [timestamp],
     * 			"updatedAt" 			=> [timestamp],
     * 			"unit" 					=> [object],
     * 			"honeysuper_date" 		=> [timestamp],
     * 		];
     * @return Response
     */
    public function store()
    {
        $inputs 	= Input::except( '_token' );
        // Refactored in BeeTools Model
        $response 	= BeeTools::entity_store( $inputs, 'honeysupers' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'honeysupers' );
    }
    /**
     * Update the specified honeysuper in storage.
     * Object structure for HTTP PUT
     * $honeysuper = [
     * 			"id" 					=> [integer][notnull],
     * 			"createdAt" 			=> [timestamp],
     * 			"updatedAt" 			=> [timestamp],
     * 			"unit" 					=> [object],
     * 			"honeysuper_date" 		=> [timestamp],
     * 		];
     * @param  int  $index
     * @return Response
     */
    public function update($index)
    {
        $honeysuper 			= Input::except( '_token' );
        $honeysuper[ 'id' ]	= (int) $index;
        // Refactored in BeeTools Model
        $response 		= BeeTools::entity_update( $honeysuper, 'honeysupers' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'honeysupers' );
    }
    /**
     * Remove the specified honeysuper from storage.
     * @param  int  $index
     * @return Response
     */
    public function delete($index)
    {
        BeeTools::entity_delete( $index, 'honeysupers' );
        return Redirect::to( 'honeysupers' );
    }

}
