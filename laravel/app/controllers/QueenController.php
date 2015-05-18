<?php
use Vinelab\Http\Client as HttpClient;

class QueenController extends \BaseController {

	/**
	 * Display a listing of the queens.
	 * @return View queens.index with all queens
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/atomic/atomic/queens" ] );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		$queens 	= $response->json();
		return View::make( 'queens.index', [ "queens" => $queens ] );
	}

	/**
	 * Display the specified queen.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
	{
		// Todo
	}
	/**
	 * Show the form for creating a new queen.
	 * @return View queens.form with queen null
	 */
	public function create()
	{
		$queen = null;
		$races = Race::get();

		return View::make( 'queens.form', [ 'queen' => $queen, 'races' => $races ] );
	}
	/**
	 * Show the form for editing the specified queen.
	 * @param  int  $id
	 * @return View queens.form with queen
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/atomic/atomic/queens/" . $id ] );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		$queen 		= $response->json();
		return View::make( 'queens.form', [ 'queen' => $queen ] );
	}
	/**
	 * Store a newly created queen in storage.
	 * Object structure for HTTP POST
	 * $queen = [
	 * 			"transaction" 	=> [object],
	 * 			"unit" 			=> [object],
	 * 			"race" 			=> [object],
	 * 			"birth_date" 	=> [timestamp],
	 * 			"death_date" 	=> [timestamp],
	 * 			"clipping" 		=> [boolean]
	 * 		];
	 * @return Response
	 */
	public function store()
	{
		$inputs 			= Input::except( '_token' );
		$inputs[ 'race' ] 	= Race::get( $inputs[ 'race' ] );
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_store( $inputs, 'queens' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'queens' );
	}
	/**
	 * Update the specified queen in storage.
	 * Object structure for HTTP PUT
	 * $queen = [
	 * 			"id" 			=> [integer][notnull],
	 * 			"transaction" 	=> [object],
	 * 			"unit" 			=> [object],
	 * 			"race" 			=> [object],
	 * 			"birth_date" 	=> [timestamp],
	 * 			"death_date" 	=> [timestamp],
	 * 			"clipping" 		=> [boolean]
	 * 		];
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$queen 			= Input::except( '_token' );
		$queen[ 'id' ] 	= (int) $id;
		// Refactored in BeeTools Model
		$response 		= BeeTools::entity_update( $queen, 'queens' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'queens' );
	}
	/**
	 * Remove the specified queen from storage.
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_delete( $id, 'queens' );
		$view 		= BeeTools::is_error( $response );
		if( $view ){
			return $view;
		}
		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'queens' );
	}

}
