<?php
use Vinelab\Http\Client as HttpClient;

class FeedingController extends BaseController {

	/**
	 * Display feedings list
	 * @return  View feedings.index with all feedings
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [
										'url' => Config::get( 'app.api' ) . "atomic/feedings",
										'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
									] );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		$feedings 		= $response->json();
		return View::make( 'feedings.index', [ "feedings" => $feedings ] );
	}
	/**
	 * Display the specified feeding.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
	{
		// Todo
	}
	/**
	 * Show the form for creating a new feeding.
	 * @return View feedings.form with feeding null
	 */
	public function create()
	{
		$feeding = null;
		return View::make( 'feedings.form', [ 'feeding' => $feeding ] );
	}
	/**
	 * Show the form for editing the specified feeding.
	 * @param  int  $id
	 * @return View feedings.form with feeding
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [
										'url' => Config::get( 'app.api' ) . "atomic/feedings/" . $id,
										'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
									] );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		$feeding 		= $response->json();
		return View::make( 'feedings.form', [ 'feeding' => $feeding ] );
	}
	/**
	 * Store a newly created feeding in storage.
	 * Object structure for HTTP POST
	 * $feeding = [
	 * 	"createdAt" 				=> [timestamp],
	 * 	"updatedAt" 				=> [timestamp],
	 * 	"feeding_date" 				=> [timestamp],
	 * 	"feeding_product_quantity" 	=> [double]
	 * 	];
	 * @return Response
	 */
	public function store()
	{
		$inputs 	= Input::except( '_token' );
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_store( $inputs, 'feedings' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'feedings' );
	}
	/**
	 * Update the specified feeding in storage.
	 * Object structure for HTTP PUT
	 * $feeding = [
	 * 	"id" 						=> [integer][notnull],
	 * 	"createdAt" 				=> [timestamp],
	 * 	"updatedAt" 				=> [timestamp],
	 * 	"feeding_date" 				=> [timestamp],
	 * 	"feeding_product_quantity" 	=> [double]
	 * 	];
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$feeding 			= Input::except( '_token' );
		$feeding[ 'id' ] 	= (int) $id;
		// Refactored in BeeTools Model
		$response 		= BeeTools::entity_update( $feeding, 'feedings' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'feedings' );
	}
	/**
	 * Remove the specified feeding from storage.
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_delete( $id, 'feedings' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'feedings' );
	}
}
