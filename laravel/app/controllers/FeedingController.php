<?php
use Vinelab\Http\Client as HttpClient;

class FeedingController extends \BaseController {

	/**
	 * Display a listing of the feedings.
	 * @return View feedings.index with all feedings
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/Feeding" ] );
		$feedings 	= $response->json();
		return View::make( 'feedings.index', [ "feedings" => $feedings ] );
	}

/**
	 * Display the specified feeding.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
	{
		// Todo
	}
	/**
	 * Show the form for creating a new feeding.
	 * @return View feedings.form with feeding null
	 */
	public function create()
	{
		$feeding = null;
		return View::make( 'feedings.form', [ 'feeding' => $feeding ] );
	}
	/**
	 * Show the form for editing the specified feeding.
	 * @param  int  $id
	 * @return View feedings.form with feeding
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/Feeding/" . $id ] );
		$feeding 		= $response->json();
		return View::make( 'feedings.form', [ 'feeding' => $feeding ] );
	}
	/**
	 * Store a newly created feeding in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs 		= Input::except( '_token' );
		$feeding 			= [ ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Feeding",
			'params' 	=>  $feeding
		];
		$client 	= new HttpClient;
		$response 	= $client->post( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}
	/**
	 * Update the specified feeding in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$inputs 		= Input::except( '_token' );
		$feeding 			= [ ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Feeding",
			'params' 	=>  $feeding
		];
		$client 	= new HttpClient;
		$response 	= $client->patch( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}
	/**
	 * Remove the specified feeding from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Feeding",
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
