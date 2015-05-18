<?php
use Vinelab\Http\Client as HttpClient;

class ProductionController extends \BaseController {

	/**
	 * Display a listing of the productions.
	 * @return View productions.index with all productions
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/atomic/atomic/productions" ] );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		$productions 	= $response->json();
		return View::make( 'productions.index', [ "productions" => $productions ] );
	}

	/**
	 * Display the specified production.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
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
	 * @param  int  $id
	 * @return View productions.form with production
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/atomic/atomic/productions/" . $id ] );
		$view 		= BeeTools::is_error( $response );
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
		$response 	= BeeTools::entity_store( $inputs, 'productions' );
		$view 		= BeeTools::is_error( $response );
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
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$production 			= Input::except( '_token' );
		$production[ 'id' ]	= (int) $id;
		// Refactored in BeeTools Model
		$response 		= BeeTools::entity_update( $production, 'productions' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'productions' );
	}
	/**
	 * Remove the specified production from storage.
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_delete( $id, 'productions' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'productions' );
	}

}
