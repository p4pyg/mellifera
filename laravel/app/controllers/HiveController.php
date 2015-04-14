<?php
use Vinelab\Http\Client as HttpClient;

class HiveController extends \BaseController {

	/**
	 * Display a listing of the hives.
	 * @return View hives.index with all hives
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/Beehive" ] );
		$hives 		= $response->json();
		return View::make( 'hives.index', [ "hives" => $hives ] );
	}

/**
	 * Display the specified hive.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
	{
		// Todo
	}
	/**
	 * Show the form for creating a new hive.
	 * @return View hives.form with hive null
	 */
	public function create()
	{
		$hive = null;
		return View::make( 'hives.form', [ 'hive' => $hive ] );
	}
	/**
	 * Show the form for editing the specified hive.
	 * @param  int  $id
	 * @return View hives.form with hive
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/Beehive/" . $id ] );
		$hive 		= $response->json();
		return View::make( 'hives.form', [ 'hive' => $hive ] );
	}
	/**
	 * Store a newly created hive in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs 		= Input::except( '_token' );
		$hive 			= [  ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Beehive",
			'params' 	=>  $hive
		];
		$client 	= new HttpClient;
		$response 	= $client->post( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}
	/**
	 * Update the specified hive in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$inputs 		= Input::except( '_token' );
		$hive 			= [ ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Beehive",
			'params' 	=>  $hive
		];
		$client 	= new HttpClient;
		$response 	= $client->patch( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}
	/**
	 * Remove the specified hive from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Beehive",
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
