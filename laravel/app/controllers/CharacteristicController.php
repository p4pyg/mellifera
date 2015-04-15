<?php
use Vinelab\Http\Client as HttpClient;

class CharacteristicController extends \BaseController {

	/**
	 * Display a listing of the characteristics.
	 * @return View characteristics.index with all characteristics
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/Characteristic" ] );
		$characteristics 	= $response->json();
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
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/Characteristic/" . $id ] );
		$characteristic 		= $response->json();
		return View::make( 'characteristics.form', [ 'characteristic' => $characteristic ] );
	}
	/**
	 * Store a newly created characteristic in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs 		= Input::except( '_token' );
		$characteristic 			= [ ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Characteristic",
			'params' 	=>  $characteristic
		];
		$client 	= new HttpClient;
		$response 	= $client->post( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}
	/**
	 * Update the specified characteristic in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$inputs 		= Input::except( '_token' );
		$characteristic 			= [ ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Characteristic",
			'params' 	=>  $characteristic
		];
		$client 	= new HttpClient;
		$response 	= $client->patch( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}
	/**
	 * Remove the specified characteristic from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Characteristic",
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
