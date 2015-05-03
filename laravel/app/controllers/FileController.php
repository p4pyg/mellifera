<?php
use Vinelab\Http\Client as HttpClient;

class FileController extends BaseController {

	/**
	 * Display files list
	 * @return  View files.index with all files
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/files" ] );
		$files 		= $response->json();
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
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/files/" . $id ] );
		$file 		= $response->json();
		return View::make( 'files.form', [ 'file' => $file ] );
	}
	/**
	 * Store a newly created file in storage.
	 * Object structure for HTTP POST
	 * $file = [
	 * 	"createdAt" => [timestamp],
	 * 	"updatedAt" => [timestamp],
	 * 	"file_name" => [string],
	 * 	"file_type" => [string],
	 * 	"url" 		=> [string],
	 * 	"notes" 	=> [string]
	 * 	];
	 * @return Response
	 */
	public function store()
	{
		$inputs 	= Input::except( '_token' );
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_store( $inputs, 'files' );

		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'files' );
	}
	/**
	 * Update the specified file in storage.
	 * Object structure for HTTP PUT
	 * $file = [
	 * 	"id" 		=> [integer][notnull],
	 * 	"createdAt" => [timestamp],
	 * 	"updatedAt" => [timestamp],
	 * 	"file_name" => [string],
	 * 	"file_type" => [string],
	 * 	"url" 		=> [string],
	 * 	"notes" 	=> [string]
	 * 	];
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$file 			= Input::except( '_token' );
		$file[ 'id' ] 	= (int) $id;
		// Refactored in BeeTools Model
		$response 		= BeeTools::entity_update( $file, 'files' );

		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'files' );
	}
	/**
	 * Remove the specified file from storage.
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_delete( $id, 'files' );

		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'files' );
	}
}
