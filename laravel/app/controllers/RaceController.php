<?php
use Vinelab\Http\Client as HttpClient;

class RaceController extends BaseController {

	/**
	 * Display races list
	 * @return  View races.index with all races
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/races" ] );
		$races 		= $response->json();
		return View::make( 'races.index', [ "races" => $races ] );
	}
	/**
	 * Display the specified race.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
	{
		// Todo
	}
	/**
	 * Show the form for creating a new race.
	 * @return View races.form with race null
	 */
	public function create()
	{
		$race = null;
		return View::make( 'races.form', [ 'race' => $race ] );
	}
	/**
	 * Show the form for editing the specified race.
	 * @param  int  $id
	 * @return View races.form with race
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/races/" . $id ] );
		$race 		= $response->json();
		return View::make( 'races.form', [ 'race' => $race ] );
	}
	/**
	 * Store a newly created race in storage.
	 * Object structure for HTTP POST
	 * $race = [
	 * 			"characteristics" 		=> [object],
	 * 			"geographical_origin" 	=> [string],
	 * 			"life_span" 			=> [integer],
	 * 			"race_name" 			=> [string]
	 * 		];
	 * @return Response
	 */
	public function store()
	{
		$inputs 	= Input::except( '_token' );
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_store( $inputs, 'races' );

		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'races' );
	}
	/**
	 * Update the specified race in storage.
	 * Object structure for HTTP PUT
	 * $race = [
	 * 			"id" 					=> [integer][notnull],
	 * 			"characteristics" 		=> [object],
	 * 			"geographical_origin" 	=> [string],
	 * 			"life_span" 			=> [integer],
	 * 			"race_name" 			=> [string]
	 * 		];
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$race 			= Input::except( '_token' );
		$race[ 'id' ] 	= (int) $id;
		// Refactored in BeeTools Model
		$response 		= BeeTools::entity_update( $race, 'races' );

		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'races' );
	}
	/**
	 * Remove the specified race from storage.
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_delete( $id, 'races' );

		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'races' );
	}
}