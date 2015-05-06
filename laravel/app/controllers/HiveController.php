<?php
use Vinelab\Http\Client as HttpClient;

class HiveController extends \BaseController {

	/**
	 * Display a listing of the hives.
	 * @return View hives.index with all hives
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/beehives" ] );
		$hives 		= $response->json();
		return View::make( 'hives.index', [ "hives" => $hives ] );
	}

/**
	 * Display the specified hive.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
	{
		// Todo
	}
	/**
	 * Show the form for creating a new hive.
	 * @return View hives.form with hive null
	 */
	public function create()
	{
		$hive = null;
		return View::make( 'hives.form', [ 'hive' => $hive ] );
	}
	/**
	 * Show the form for editing the specified hive.
	 * @param  int  $id
	 * @return View hives.form with hive
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/beehives/" . $id ] );
		$hive 		= $response->json();
		return View::make( 'hives.form', [ 'hive' => $hive ] );
	}
	/**
	 * Store a newly created hive in storage.
	 * Object structure for HTTP POST
	 * $hive = [
	 * 		"createdAt" 		=> [timestamp],
	 * 		"updatedAt" 		=> [timestamp],
	 * 		"trades" 			=> [object],
	 * 		"units" 			=> [object],
	 * 		"id_lot" 			=> [integer],
	 * 		"beehive_type" 		=> [string],
	 * 		"number_of_frames"	=> [integer],
	 * 		"number_of_rocks" 	=> [integer],
	 * 		"notes" 			=> [string]
	 * 		];
	 * @return Response
	 */
	public function store()
	{
		$inputs 	= Input::except( '_token' );
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_store( $inputs, 'beehives' );
		if( $response->statusCode() != 200 ){
			$error['code'] = $response->statusCode();
			$error['message'] = $response->content();
			return View::make( 'errors.http_response', [ 'response' => $error ] );
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'hives' );
	}
	/**
	 * Update the specified hive in storage.
	 * Object structure for HTTP PUT
	 * $hive = [
	 * 		"id" 				=> [integer][notnull],
	 * 		"createdAt" 		=> [timestamp],
	 * 		"updatedAt" 		=> [timestamp],
	 * 		"trades" 			=> [object],
	 * 		"units" 			=> [object],
	 * 		"id_lot" 			=> [integer],
	 * 		"beehive_type" 		=> [string],
	 * 		"number_of_frames"	=> [integer],
	 * 		"number_of_rocks" 	=> [integer],
	 * 		"notes" 			=> [string]
	 * 		];
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$hive 			= Input::except( '_token' );
		$hive[ 'id' ] 	= (int)$id;
		// Refactored in BeeTools Model
		$response 		= BeeTools::entity_update( $hive, 'beehives' );
		if( $response->statusCode() != 200 ){
			$error['code'] = $response->statusCode();
			$error['message'] = $response->content();
			return View::make( 'errors.http_response', [ 'response' => $error ] );
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'hives' );
	}
	/**
	 * Remove the specified hive from storage.
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_delete( $id, 'beehives' );
		if( $response->statusCode() != 200 ){
			$error['code'] = $response->statusCode();
			$error['message'] = $response->content();
			return View::make( 'errors.http_response', [ 'response' => $error ] );
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'hives' );
	}

}
