<?php
use Vinelab\Http\Client as HttpClient;

class NuisanceController extends \BaseController
{
    /**
     * Display a listing of the nuisances.
     * @return View nuisances.index with all nuisances
     */
    public function index()
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/nuisances", 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $nuisances 	= $response->json();
        return View::make( 'nuisances.index', [ "nuisances" => $nuisances ] );
    }

    /**
     * Display the specified nuisance.
     *
     * @param  int  $index
     * @return Response
     */
    public function show($index)
    {
        // Todo
    }
    /**
     * Show the form for creating a new nuisance.
     * @return View nuisances.form with nuisance null
     */
    public function create()
    {
        $nuisance = null;
        return View::make( 'nuisances.form', [ 'nuisance' => $nuisance ] );
    }
    /**
     * Show the form for editing the specified nuisance.
     * @param  int  $index
     * @return View nuisances.form with nuisance
     */
    public function edit($index)
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/nuisances/" . $index, 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $nuisance 		= $response->json();
        return View::make( 'nuisances.form', [ 'nuisance' => $nuisance ] );
    }
    /**
     * Store a newly created nuisance in storage.
     * Object structure for HTTP POST
     * $nuisance = [
     * 			"createdAt" 			=> [timestamp],
     * 			"updatedAt" 			=> [timestamp],
     * 			"nuisance_date" 		=> [timestamp],
     * 			"nuisance_type" 		=> [string],
     * 		];
     * @return Response
     */
    public function store()
    {
        $inputs 	= Input::except( '_token' );
        // Refactored in BeeTools Model
        $response 	= BeeTools::entity_store( $inputs, 'nuisances' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'nuisances' );
    }
    /**
     * Update the specified nuisance in storage.
     * Object structure for HTTP PUT
     * $nuisance = [
     * 			"id" 					=> [integer][notnull],
     * 			"createdAt" 			=> [timestamp],
     * 			"updatedAt" 			=> [timestamp],
     * 			"nuisance_date" 		=> [timestamp],
     * 			"nuisance_type" 		=> [string],
     * 		];
     * @param  int  $index
     * @return Response
     */
    public function update($index)
    {
        $nuisance 			= Input::except( '_token' );
        $nuisance[ 'id' ]	= (int) $index;
        // Refactored in BeeTools Model
        $response 		= BeeTools::entity_update( $nuisance, 'nuisances' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'nuisances' );
    }
    /**
     * Remove the specified nuisance from storage.
     * @param  int  $index
     * @return Response
     */
    public function delete($index)
    {
        // Refactored in BeeTools Model
        $response 	= BeeTools::entity_delete( $index, 'nuisances' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'nuisances' );
    }

}
