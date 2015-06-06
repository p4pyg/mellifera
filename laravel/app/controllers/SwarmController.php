<?php
use Vinelab\Http\Client as HttpClient;

class SwarmController extends \BaseController {

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
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
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
	 * @param  int  $id
	 * @return View swarms.form with swarm
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/swarms/" . $id, 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
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
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$swarm 			= Input::except( '_token' );
		$swarm[ 'id' ]	= (int) $id;
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
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_delete( $id, 'swarms' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'swarms' );
	}

}
