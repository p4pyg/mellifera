<?php
use Vinelab\Http\Client as HttpClient;

class ApiaryController extends BaseController {

	/**
	 * Display apiaries list
	 * @return  View apiaries.index with all apiaries
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/atomic/atomic/apiaries" ] );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}

		$apiaries 	= $response->json();
		return View::make( 'apiaries.index', [ "apiaries" => $apiaries ] );
	}
	/**
	 * Display the specified apiary.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
	{
		// Todo
	}
	/**
	 * Show the form for creating a new apiary.
	 * @return View apiaries.form with apiary null
	 */
	public function create()
	{
		$apiary = null;
		return View::make( 'apiaries.form', [ 'apiary' => $apiary ] );
	}
	/**
	 * Show the form for editing the specified apiary.
	 * @param  int  $id
	 * @return View apiaries.form with apiary
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/atomic/atomic/apiaries/" . $id ] );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		$apiary 	= $response->json();
		return View::make( 'apiaries.form', [ 'apiary' => $apiary ] );
	}
	/**
	 * Store a newly created apiary in storage.
	 * Object structure for HTTP POST
	 * $apiary = [
	 * 			"createdAt" 		=> [timestamp],
	 * 			"updatedAt" 		=> [timestamp],
	 * 			"weathers" 			=> [object],
	 * 			"apiary_name" 		=> [string],
	 * 			"address1" 			=> [string],
	 * 			"address2" 			=> [string],
	 * 			"postcode" 			=> [integer],
	 * 			"city" 				=> [string],
	 * 			"longitude" 		=> [double],
	 * 			"latitude" 			=> [double],
	 * 			"altitude" 			=> [integer],
	 * 			"vegetation_type" 	=> [string],
	 * 			"hives_capacity" 	=> [integer],
	 * 			"apiary_notes" 		=> [string],
	 * 			"notes" 			=> [integer]
	 * 		];
	 * @return Response
	 */
	public function store()
	{
		$inputs 	= Input::except( '_token' );
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_store( $inputs, 'apiaries' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'apiaries' );
	}
	/**
	 * Update the specified apiary in storage.
	 * Object structure for HTTP PUT
	 * $apiary = [
	 * 			"id" 				=> [integer][notnull],
	 * 			"createdAt" 		=> [timestamp],
	 * 			"updatedAt" 		=> [timestamp],
	 * 			"weathers" 			=> [object],
	 * 			"apiary_name" 		=> [string],
	 * 			"address1" 			=> [string],
	 * 			"address2" 			=> [string],
	 * 			"postcode" 			=> [integer],
	 * 			"city" 				=> [string],
	 * 			"longitude" 		=> [double],
	 * 			"latitude" 			=> [double],
	 * 			"altitude" 			=> [integer],
	 * 			"vegetation_type" 	=> [string],
	 * 			"hives_capacity" 	=> [integer],
	 * 			"notes" 			=> [string],
	 * 			"rank" 				=> [integer]
	 * 		];
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$apiary 			= Input::except( '_token' );
		$apiary[ 'id' ] 	= (int) $id;
		// Refactored in BeeTools Model
		$response 		= BeeTools::entity_update( $apiary, 'apiaries' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'apiaries' );
	}
	/**
	 * Remove the specified apiary from storage.
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_delete( $id, 'apiaries' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'apiaries' );
	}
}
