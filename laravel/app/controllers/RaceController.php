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
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/atomic/races" ] );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
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
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/atomic/races/" . $id ] );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
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
		$inputs = Input::except( '_token', 'characteristic_id');
		$race 	= Input::except( '_token', 'characteristic_id', 'characteristic_date', 'characteristic_racial_type', 'characteristic_aggressivness_level', 'characteristic_swarming_level', 'characteristic_winter_hardiness_level', 'characteristic_wake_up_month', 'characteristic_comment' );


		$characteristics = [];
		foreach ( $inputs as $key => $input )
			if( str_contains( $key, 'characteristic_' ) )
				$characteristics[ str_replace( 'characteristic_', '', $key ) ] = $input;

		$characteristics[ 'date' ] 	= date( 'Y-m-d', strtotime( $characteristics[ 'date' ] ) );
		// Refactored in BeeTools Model
		$response_characteristic 	= BeeTools::entity_store( $characteristics, 'characteristics' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		$race['characteristics'] 	= $response_characteristic;
		// Refactored in BeeTools Model
		$response_race 				= BeeTools::entity_store( $race, 'races' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
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
		$inputs = Input::except( '_token' );
		$race 	= Input::except( '_token', 'characteristic_id', 'characteristic_date', 'characteristic_racial_type', 'characteristic_aggressivness_level', 'characteristic_swarming_level', 'characteristic_winter_hardiness_level', 'characteristic_wake_up_month', 'characteristic_comment' );


		$characteristics = [];
		foreach ( $inputs as $key => $input )
			if( str_contains( $key, 'characteristic_' ) )
				$characteristics[ str_replace( 'characteristic_', '', $key ) ] = $input;

		$characteristics[ 'date' ] 	= date( 'Y-m-d', strtotime( $characteristics[ 'date' ] ) );
		if( $characteristics['id'] == '' ){
			unset( $characteristics['id'] );
			$response_characteristic 	= BeeTools::entity_store( $characteristics, 'characteristics' );
		}
		else
			$response_characteristic 	= BeeTools::entity_update( $characteristics, 'characteristics' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		$race[ 'id' ] 	= (int) $id;
		$race['characteristics'] 	= $response_characteristic;
		// Refactored in BeeTools Model
		$response 		= BeeTools::entity_update( $race, 'races' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}

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
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'races' );
	}
}
