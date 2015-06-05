<?php
use Vinelab\Http\Client as HttpClient;

class NuisanceController extends \BaseController {

	/**
	 * Display a listing of the nuisances.
	 * @return View nuisances.index with all nuisances
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/nuisances" ] );
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
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
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
	 * @param  int  $id
	 * @return View nuisances.form with nuisance
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/nuisances/" . $id ] );
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
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$nuisance 			= Input::except( '_token' );
		$nuisance[ 'id' ]	= (int) $id;
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
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_delete( $id, 'nuisances' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'nuisances' );
	}

}
