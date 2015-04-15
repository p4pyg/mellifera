<?php
use Vinelab\Http\Client as HttpClient;

class FileController extends \BaseController {

	/**
	 * Display a listing of the files.
	 * @return View files.index with all files
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/File" ] );
		$files 	= $response->json();
		return View::make( 'files.index', [ "files" => $files ] );
	}

/**
	 * Display the specified file.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
	{
		// Todo
	}
	/**
	 * Show the form for creating a new file.
	 * @return View files.form with file null
	 */
	public function create()
	{
		$file = null;
		return View::make( 'files.form', [ 'file' => $file ] );
	}
	/**
	 * Show the form for editing the specified file.
	 * @param  int  $id
	 * @return View files.form with file
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/File/" . $id ] );
		$file 		= $response->json();
		return View::make( 'files.form', [ 'file' => $file ] );
	}
	/**
	 * Store a newly created file in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs 		= Input::except( '_token' );
		$file 			= [ ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/File",
			'params' 	=>  $file
		];
		$client 	= new HttpClient;
		$response 	= $client->post( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}
	/**
	 * Update the specified file in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$inputs 		= Input::except( '_token' );
		$file 			= [ ];

		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/File",
			'params' 	=>  $file
		];
		$client 	= new HttpClient;
		$response 	= $client->patch( $request );

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		die('<p style="color:orange; font-weight:bold;">Debug</p>');
	}
	/**
	 * Remove the specified file from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/File",
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
