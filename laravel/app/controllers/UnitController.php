<?php
use Vinelab\Http\Client as HttpClient;

class UnitController extends \BaseController {

	/**
	 * Display a listing of the units.
	 * @return View units.index with all units
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/units" ] );
		$units 	= $response->json();
		return View::make( 'units.index', [ "units" => $units ] );
	}

	/**
	 * Display the specified unit.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
	{
		// Todo
	}
	/**
	 * Show the form for creating a new unit.
	 * @return View units.form with unit null
	 */
	public function create()
	{
		$unit = null;
		return View::make( 'units.form', [ 'unit' => $unit ] );
	}
	/**
	 * Show the form for editing the specified unit.
	 * @param  int  $id
	 * @return View units.form with unit
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/units/" . $id ] );
		$unit 		= $response->json();
		return View::make( 'units.form', [ 'unit' => $unit ] );
	}
	/**
	 * Store a newly created unit in storage.
	 * Object structure for HTTP POST
	 * $unit = [
	 * 			"createdAt" 			=> [timestamp],
	 * 			"updatedAt" 			=> [timestamp],
	 * 			"characteristics" 		=> [object],
	 * 			"daugthers" 			=> [object],
	 * 			"sons" 					=> [object],
	 * 			"files" 				=> [object],
	 * 			"productions" 			=> [object],
	 * 			"association_date" 		=> [timestamp],
	 * 			"separation_date" 		=> [timestamp]
	 * 		];
	 * @return Response
	 */
	public function store()
	{
		$inputs 	= Input::except( '_token' );
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_store( $inputs, 'units' );
		if( $response->statusCode() != 200 ){
			$error['code'] = $response->statusCode();
			$error['message'] = $response->content();
			return View::make( 'errors.http_response', [ 'response' => $error ] );
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'units' );
	}
	/**
	 * Update the specified unit in storage.
	 * Object structure for HTTP PUT
	 * $unit = [
	 * 			"id" 					=> [integer][notnull],
	 * 			"createdAt" 			=> [timestamp],
	 * 			"updatedAt" 			=> [timestamp],
	 * 			"characteristics" 		=> [object],
	 * 			"daugthers" 			=> [object],
	 * 			"sons" 					=> [object],
	 * 			"files" 				=> [object],
	 * 			"productions" 			=> [object],
	 * 			"association_date" 		=> [timestamp],
	 * 			"separation_date" 		=> [timestamp]
	 * 		];
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$unit 			= Input::except( '_token' );
		$unit[ 'id' ]	= (int) $id;
		// Refactored in BeeTools Model
		$response 		= BeeTools::entity_update( $unit, 'units' );
		if( $response->statusCode() != 200 ){
			$error['code'] = $response->statusCode();
			$error['message'] = $response->content();
			return View::make( 'errors.http_response', [ 'response' => $error ] );
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'units' );
	}
	/**
	 * Remove the specified unit from storage.
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_delete( $id, 'units' );
		if( $response->statusCode() != 200 ){
			$error['code'] = $response->statusCode();
			$error['message'] = $response->content();
			return View::make( 'errors.http_response', [ 'response' => $error ] );
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'units' );
	}

}
