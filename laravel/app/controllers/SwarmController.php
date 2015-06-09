<?php
use Vinelab\Http\Client as HttpClient;

class SwarmController extends \BaseController
{
    /**
     * Display a listing of the swarms.
     * @return View swarms.index with all swarms
     */
    public function index()
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/swarms", 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $swarms 	= $response->json();
        return View::make( 'swarms.index', [ "swarms" => $swarms ] );
    }

    /**
     * Display the specified swarm.
     *
     * @param  int  $index
     * @return Response
     */
    public function show($index)
    {
        // Todo
    }
    /**
     * Show the form for creating a new swarm.
     * @return View swarms.form with swarm null
     */
    public function create()
    {
        $swarm = null;
        return View::make( 'swarms.form', [ 'swarm' => $swarm ] );
    }
    /**
     * Show the form for editing the specified swarm.
     * @param  int  $index
     * @return View swarms.form with swarm
     */
    public function edit($index)
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/swarms/" . $index, 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $swarm 		= $response->json();
        return View::make( 'swarms.form', [ 'swarm' => $swarm ] );
    }
    /**
     * Store a newly created swarm in storage.
     * Object structure for HTTP POST
     * $swarm = [
     * 			"createdAt" 			=> [timestamp],
     * 			"updatedAt" 			=> [timestamp],
     * 			"is_in" 				=> [object],
     * 			"trades" 				=> [object],
     * 			"creation_date" 		=> [timestamp],
     * 			"extermination_date" 	=> [timestamp],
     * 			"purpose" 				=> [string],
     * 			"notes" 				=> [string]
     * 		];
     * @return Response
     */
    public function store()
    {
        $inputs 	= Input::except( '_token' );
        // Refactored in BeeTools Model
        $response 	= BeeTools::entity_store( $inputs, 'swarms' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'swarms' );
    }
    /**
     * Update the specified swarm in storage.
     * Object structure for HTTP PUT
     * $swarm = [
     * 			"id" 					=> [integer][notnull],
     * 			"createdAt" 			=> [timestamp],
     * 			"updatedAt" 			=> [timestamp],
     * 			"is_in" 				=> [object],
     * 			"trades" 				=> [object],
     * 			"creation_date" 		=> [timestamp],
     * 			"extermination_date" 	=> [timestamp],
     * 			"purpose" 				=> [string],
     * 			"notes" 				=> [string]
     * 		];
     * @param  int  $index
     * @return Response
     */
    public function update($index)
    {
        $swarm 			= Input::except( '_token' );
        $swarm[ 'id' ]	= (int) $index;
        // Refactored in BeeTools Model
        $response 		= BeeTools::entity_update( $swarm, 'swarms' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'swarms' );
    }
    /**
     * Remove the specified swarm from storage.
     * @param  int  $index
     * @return Response
     */
    public function delete($index)
    {
        // Refactored in BeeTools Model
        $response 	= BeeTools::entity_delete( $index, 'swarms' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'swarms' );
    }

}
