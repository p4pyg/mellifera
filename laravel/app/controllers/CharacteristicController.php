<?php
use Vinelab\Http\Client as HttpClient;

class CharacteristicController extends BaseController {

	/**
	 * Display characteristics list
	 * @return  View characteristics.index with all characteristics
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/atomic/atomic/characteristics" ] );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		$characteristics 		= $response->json();
		return View::make( 'characteristics.index', [ "characteristics" => $characteristics ] );
	}
	/**
	 * Display the specified characteristic.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
	{
		// Todo
	}
	/**
	 * Show the form for creating a new characteristic.
	 * @return View characteristics.form with characteristic null
	 */
	public function create()
	{
		$characteristic = null;
		return View::make( 'characteristics.form', [ 'characteristic' => $characteristic ] );
	}
	/**
	 * Show the form for editing the specified characteristic.
	 * @param  int  $id
	 * @return View characteristics.form with characteristic
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/atomic/atomic/characteristics/" . $id ] );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		$characteristic 		= $response->json();
		return View::make( 'characteristics.form', [ 'characteristic' => $characteristic ] );
	}
	/**
	 * Store a newly created characteristic in storage.
	 * Object structure for HTTP POST
	 * $characteristic = [
	 * 					"createdAt" 			=> [timestamp],
	 * 					"updatedAt" 			=> [timestamp],
	 * 					"date" 					=> [timestamp],
	 * 					"racial_type" 			=> [string],
	 * 					"aggressivness_level" 	=> [integer],
	 * 					"swarming_level" 		=> [integer],
	 * 					"winter_hardiness_level"=> [integer],
	 * 					"wake_up_month" 		=> [string]
	 * 				];
	 * @return Response
	 */
	public function store()
	{
		$inputs 	= Input::except( '_token' );
		$inputs[ 'date' ] 	= date( 'Y-m-d', strtotime( $inputs[ 'date' ] ) );
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_store( $inputs, 'characteristics' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'characteristics' );
	}
	/**
	 * Update the specified characteristic in storage.
	 * Object structure for HTTP PUT
	 * $characteristic = [
	 * 					"id" 					=> [integer][notnull],
	 * 					"createdAt" 			=> [timestamp],
	 * 					"updatedAt" 			=> [timestamp],
	 * 					"date" 					=> [timestamp],
	 * 					"racial_type" 			=> [string],
	 * 					"aggressivness_level" 	=> [integer],
	 * 					"swarming_level" 		=> [integer],
	 * 					"winter_hardiness_level"=> [integer],
	 * 					"wake_up_month" 		=> [string]
	 * 				];
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$characteristic 			= Input::except( '_token' );
		$characteristic[ 'id' ] 	= (int) $id;
		$characteristic[ 'date' ] 	= date( 'Y-m-d', strtotime( $characteristic[ 'date' ] ) );
		// Refactored in BeeTools Model
		$response 		= BeeTools::entity_update( $characteristic, 'characteristics' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'characteristics' );
	}
	/**
	 * Remove the specified characteristic from storage.
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_delete( $id, 'characteristics' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'characteristics' );
	}
}
