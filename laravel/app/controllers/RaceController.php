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
		foreach ( $inputs as $key => $input )
			$inputs[$key] = $input === '' ? null : $input;

		$race 			= [ "characteristics" => $inputs['characteristics' ], "geographical_origin" => $inputs['geographical_origin' ], "life_span" => $inputs['life_span' ], "race_name" => $inputs['race_name'] ];


		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Race",
			'params' 	=> json_encode( $race ),
			'headers' 	=> ['Content-type: application/json' ]
		];
		$client 	= new HttpClient;
		$response 	= $client->post( $request );

		// WORK IN PROGRESS
		// return response
	}
	/**
	 * Update the specified race in storage.
	 * ===============================================================> /!\ WARNING /!\  HTTP Verbs PUT =======> all parameters are provided !
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$inputs 		= Input::except( '_token' );
		foreach ( $inputs as $key => $input )
			$inputs[$key] = $input === '' ? null : $input;

		$race 			= [ "id" => (int) $id , "characteristics" => $inputs['characteristics' ], "geographical_origin" => $inputs['geographical_origin' ], "life_span" => $inputs['life_span' ], "race_name" => $inputs['race_name'] ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Race",
			'params' 	=>  json_encode( $race ),
			'headers' 	=> ['Content-type: application/json' ]
		];
		$client 	= new HttpClient;
		$response 	= $client->put( $request );

		// WORK IN PROGRESS
		// return response
	}
	/**
	 * Remove the specified race from storage.
	 * ===============================================================> /!\ WARNING /!\  HTTP Verbs DELETE =======> No action found !
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Race",
			// WORK IN PROGRESS
			// 'params' 	=> json_encode( [ "id" => (int) $id ] ),
			// 'params' 	=> '{"id":' . (int) $id . '}',
			'params' 	=> $id,
			'headers' 	=> ['Content-type: application/json' ]
		];
		$client 	= new HttpClient;
		$response 	= $client->delete( $request );

		// WORK IN PROGRESS
		// return response
	}
}
