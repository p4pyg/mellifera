<?php
use Vinelab\Http\Client as HttpClient;

class PersonController extends \BaseController {

	/**
	 * Display a listing of the persons.
	 * @return View persons.index with all persons
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/Person" ] );
		$persons 	= $response->json();
		return View::make( 'persons.index', [ "persons" => $persons ] );
	}

/**
	 * Display the specified person.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
	{
		// Todo
	}
	/**
	 * Show the form for creating a new person.
	 * @return View persons.form with person null
	 */
	public function create()
	{
		$person = null;
		return View::make( 'persons.form', [ 'person' => $person ] );
	}
	/**
	 * Show the form for editing the specified person.
	 * @param  int  $id
	 * @return View persons.form with person
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/Person/" . $id ] );
		$person 		= $response->json();
		return View::make( 'persons.form', [ 'person' => $person ] );
	}
	/**
	 * Store a newly created person in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs 		= Input::except( '_token' );
		$person 			= [ ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Person",
			'params' 	=>  $person
		];
		$client 	= new HttpClient;
		$response 	= $client->post( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}
	/**
	 * Update the specified person in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$inputs 		= Input::except( '_token' );
		$person 			= [ ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Person",
			'params' 	=>  $person
		];
		$client 	= new HttpClient;
		$response 	= $client->patch( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}
	/**
	 * Remove the specified person from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/Person",
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
