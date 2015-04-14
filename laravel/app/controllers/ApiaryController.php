<?php
use Vinelab\Http\Client as HttpClient;

class ApiaryController extends \BaseController {

	/**
	 * Display a listing of the apiaries.
	 * @return View apiaries.index with all apiaries
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/Apiary" ] );
		$apiaries 	= $response->json();
		return View::make( 'apiaries.index', [ "apiaries" => $apiaries ] );
	}

/**
	 * Display the specified apiary.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
	{
		// Todo
	}
	/**
	 * Show the form for creating a new apiary.
	 * @return View apiaries.form with apiary null
	 */
	public function create()
	{
		$apiary = null;
		return View::make( 'apiaries.form', [ 'apiary' => $apiary ] );
	}
	/**
	 * Show the form for editing the specified apiary.
	 * @param  int  $id
	 * @return View apiaries.form with apiary
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/Apiary/" . $id ] );
		$apiary 		= $response->json();
		return View::make( 'apiaries.form', [ 'apiary' => $apiary ] );
	}
	/**
	 * Store a newly created apiary in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs 		= Input::except( '_token' );
		$apiary 			= [  ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Apiary",
			'params' 	=>  $apiary
		];
		$client 	= new HttpClient;
		$response 	= $client->post( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}
	/**
	 * Update the specified apiary in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$inputs 		= Input::except( '_token' );
		$apiary 			= [ ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Apiary",
			'params' 	=>  $apiary
		];
		$client 	= new HttpClient;
		$response 	= $client->patch( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}
	/**
	 * Remove the specified apiary from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Apiary",
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
