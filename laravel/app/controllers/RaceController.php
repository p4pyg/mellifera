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
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/Race" ] );
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
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/Race/" . $id ] );
		$race 		= $response->json();
		return View::make( 'races.form', [ 'race' => $race ] );
	}
	/**
	 * Store a newly created race in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs 		= Input::except( '_token' );
		$race 			= [ "characteristics" => $inputs['characteristics' ], "geographical_origin" => $inputs['geographical_origin' ], "life_span" => $inputs['life_span' ], "race_name" => $inputs['race_name'] ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Race",
			'params' 	=>  $race
		];
		$client 	= new HttpClient;
		$response 	= $client->post( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}
	/**
	 * Update the specified race in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$inputs 		= Input::except( '_token' );
		$race 			= [ "id" => (int) $id , "characteristics" => $inputs['characteristics' ], "geographical_origin" => $inputs['geographical_origin' ], "life_span" => $inputs['life_span' ], "race_name" => $inputs['race_name'] ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Race",
			'params' 	=>  $race
		];
		$client 	= new HttpClient;
		$response 	= $client->patch( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}
	/**
	 * Remove the specified race from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Race",
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
