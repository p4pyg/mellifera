<?php
use Vinelab\Http\Client as HttpClient;

class SwarmController extends \BaseController {

	/**
	 * Display a listing of the swarms.
	 * @return View swarms.index with all swarms
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/Swarm" ] );
		$swarms 	= $response->json();
		return View::make( 'swarms.index', [ "swarms" => $swarms ] );
	}

/**
	 * Display the specified swarm.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
	{
		// Todo
	}
	/**
	 * Show the form for creating a new swarm.
	 * @return View swarms.form with swarm null
	 */
	public function create()
	{
		$swarm = null;
		return View::make( 'swarms.form', [ 'swarm' => $swarm ] );
	}
	/**
	 * Show the form for editing the specified swarm.
	 * @param  int  $id
	 * @return View swarms.form with swarm
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/Swarm/" . $id ] );
		$swarm 		= $response->json();
		return View::make( 'swarms.form', [ 'swarm' => $swarm ] );
	}
	/**
	 * Store a newly created swarm in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs 		= Input::except( '_token' );
		$swarm 			= [ ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Swarm",
			'params' 	=>  $swarm
		];
		$client 	= new HttpClient;
		$response 	= $client->post( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}
	/**
	 * Update the specified swarm in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$inputs 		= Input::except( '_token' );
		$swarm 			= [ ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Swarm",
			'params' 	=>  $swarm
		];
		$client 	= new HttpClient;
		$response 	= $client->patch( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}
	/**
	 * Remove the specified swarm from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Swarm",
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
