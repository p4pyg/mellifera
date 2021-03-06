<?php
use Vinelab\Http\Client as HttpClient;

class ProductionController extends \BaseController
{
    /**
     * Display a listing of the productions.
     * @return View productions.index with all productions
     */
    public function index()
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/productions", 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
        $productions 	= $response->json();
        return View::make( 'productions.index', [ "productions" => $productions ] );
    }

    /**
     * Display the specified production.
     *
     * @param  int  $index
     * @return Response
     */
    public function show($index)
    {
        // Todo
    }
    /**
     * Show the form for creating a new production.
     * @return View productions.form with production null
     */
    public function create()
    {
        $production = null;
        return View::make( 'productions.form', [ 'production' => $production ] );
    }
    /**
     * Show the form for editing the specified production.
     * @param  int  $index
     * @return View productions.form with production
     */
    public function edit($index)
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/productions/" . $index, 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
        $production 		= $response->json();
        return View::make( 'productions.form', [ 'production' => $production ] );
    }
    /**
     * Store a newly created production in storage.
     * Object structure for HTTP POST
     * $production = [
     * 			"createdAt" 		=> [timestamp],
     * 			"updatedAt" 		=> [timestamp],
     * 			"nuisances" 		=> [object],
     * 			"feedings" 			=> [object],
     * 			"treatments" 		=> [object],
     * 			"arrival_date_of_hive" 		=> [timestamp],
     * 			"departure_date_of_hive" 	=> [timestamp],
     * 			"harvest_date" 		=> [timestamp],
     * 			"harvest_weight" 	=> [integer]
     * 		];
     * @return Response
     */
    public function store()
    {
        $inputs 	= Input::except( '_token' );
        // Refactored in BeeTools Model
        $response 	= BeeTools::entityStore( $inputs, 'productions' );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'productions' );
    }
    /**
     * Update the specified production in storage.
     * Object structure for HTTP PUT
     * $production = [
     * 			"id" 				=> [integer][notnull],
     * 			"createdAt" 		=> [timestamp],
     * 			"updatedAt" 		=> [timestamp],
     * 			"nuisances" 		=> [object],
     * 			"feedings" 			=> [object],
     * 			"treatments" 		=> [object],
     * 			"arrival_date_of_hive" 		=> [timestamp],
     * 			"departure_date_of_hive" 	=> [timestamp],
     * 			"harvest_date" 		=> [timestamp],
     * 			"harvest_weight" 	=> [integer]
     * 		];
     * @param  int  $index
     * @return Response
     */
    public function update($index)
    {
        $production 			= Input::except( '_token' );
        $production[ 'id' ]	= (int) $index;
        // Refactored in BeeTools Model
        $response 		= BeeTools::entityUpdate( $production, 'productions' );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'productions' );
    }
    /**
     * Remove the specified production from storage.
     * @param  int  $index
     * @return Response
     */
    public function delete($index)
    {
        BeeTools::entityDelete( $index, 'productions' );
        return Redirect::to( 'productions' );
    }

}
