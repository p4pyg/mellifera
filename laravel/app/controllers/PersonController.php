<?php
use Vinelab\Http\Client as HttpClient;

class PersonController extends \BaseController {

	/**
	 * Display a listing of the persons.
	 * @return View persons.index with all persons
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/persons" ] );
		$persons 	= $response->json();
		return View::make( 'persons.index', [ "persons" => $persons ] );
	}

/**
	 * Display the specified person.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
	{
		// Todo
	}
	/**
	 * Show the form for creating a new person.
	 * @return View persons.form with person null
	 */
	public function create()
	{
		$person = null;
		return View::make( 'persons.form', [ 'person' => $person ] );
	}
	/**
	 * Show the form for editing the specified person.
	 * @param  int  $id
	 * @return View persons.form with person
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/persons/" . $id ] );
		$person 	= $response->json();
		return View::make( 'persons.form', [ 'person' => $person ] );
	}
	/**
	 * Store a newly created person in storage.
	 * Object structure for HTTP POST
	 * $person = [
	 * 			"createdAt" 			=> [timestamp],
	 * 			"updatedAt" 			=> [timestamp],
	 * 			"last_name" 			=> [string],
	 * 			"first_name" 			=> [string],
	 * 			"address1" 				=> [string],
	 * 			"address2" 				=> [string],
	 * 			"postcode" 				=> [integer],
	 * 			"city" 					=> [string],
	 * 			"phone" 				=> [long],
	 * 			"email" 				=> [string],
	 * 			"notes" 				=> [string],
	 * 			"user" 					=> [object],
	 * 			"trades_with_sellers" 	=> [object],
	 * 			"trades_with_buyers" 	=> [object]
	 * 		];
	 * @return Response
	 */
	public function store()
	{
		$inputs = Input::except( '_token' );
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_store( $inputs, 'persons' );

		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'persons' );
	}
	/**
	 * Update the specified person in storage.
	 * Object structure for HTTP PUT
	 * $person = [
	 * 			"id" 					=> [integer][notnull],
	 * 			"createdAt" 			=> [timestamp],
	 * 			"updatedAt" 			=> [timestamp],
	 * 			"last_name" 			=> [string],
	 * 			"first_name" 			=> [string],
	 * 			"address1" 				=> [string],
	 * 			"address2" 				=> [string],
	 * 			"postcode" 				=> [integer],
	 * 			"city" 					=> [string],
	 * 			"phone" 				=> [long],
	 * 			"email" 				=> [string],
	 * 			"notes" 				=> [string],
	 * 			"user" 					=> [object],
	 * 			"trades_with_sellers" 	=> [object],
	 * 			"trades_with_buyers" 	=> [object]
	 * 		];
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$person = Input::except( '_token' );
		$person[ 'id' ] = (int) $id;
		// Refactored in BeeTools Model
		$response 		= BeeTools::entity_update( $person, 'persons' );

		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'persons' );
	}
	/**
	 * Remove the specified person from storage.
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_delete( $id, 'persons' );

		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'persons' );
	}

}
