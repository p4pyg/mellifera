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
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/Queen" ] );
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
		return View::make( 'queens.form', [ 'queen' => $queen ] );
	}
	/**
	 * Show the form for editing the specified queen.
	 * @param  int  $id
	 * @return View queens.form with queen
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/Queen/" . $id ] );
		$queen 		= $response->json();
		return View::make( 'queens.form', [ 'queen' => $queen ] );
	}
	/**
	 * Store a newly created queen in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs 		= Input::except( '_token' );
		$queen 			= [ "transaction" => $inputs['transaction'], "unit" => $inputs['unit'], "race" => $race, "birth_date" => date( 'Y-m-d h:i:s', strtotime( $inputs['birth_date'] ) ), "death_date" => date( 'Y-m-d h:i:s', strtotime( $inputs['death_date'] ) ), "clipping" => (bool)$inputs['clipping'] ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Queen",
			'params' 	=>  $queen
		];
		$client 	= new HttpClient;
		$response 	= $client->post( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}
	/**
	 * Update the specified queen in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$inputs 		= Input::except( '_token' );
		$queen 			= [ "id" => (int) $id, 	"transaction" => $inputs['transaction'], "unit" => $inputs['unit'], "race" => $race, "birth_date" => date( 'Y-m-d h:i:s', strtotime( $inputs['birth_date'] ) ), "death_date" => date( 'Y-m-d h:i:s', strtotime( $inputs['death_date'] ) ), "clipping" => (bool)$inputs['clipping'] ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Queen",
			'params' 	=>  $queen
		];
		$client 	= new HttpClient;
		$response 	= $client->patch( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}
	/**
	 * Remove the specified queen from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Queen",
			'params' 	=> [ "id" => (int) $id ]
		];
		$client 	= new HttpClient;
		$response 	= $client->delete( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}

}
