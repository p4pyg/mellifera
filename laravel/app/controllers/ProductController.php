<?php
use Vinelab\Http\Client as HttpClient;

class ProductController extends \BaseController {

	/**
	 * Display a listing of the products.
	 * @return View products.index with all products
	 */
	public function index()
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/products" ] );
		$products 	= $response->json();
		return View::make( 'products.index', [ "products" => $products ] );
	}

	/**
	 * Display the specified product.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
	{
		// Todo
	}
	/**
	 * Show the form for creating a new product.
	 * @return View products.form with product null
	 */
	public function create()
	{
		$product = null;
		return View::make( 'products.form', [ 'product' => $product ] );
	}
	/**
	 * Show the form for editing the specified product.
	 * @param  int  $id
	 * @return View products.form with product
	 */
	public function edit( $id )
	{
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "https://bee-mellifera.herokuapp.com/products/" . $id ] );
		$product 		= $response->json();
		return View::make( 'products.form', [ 'product' => $product ] );
	}
	/**
	 * Store a newly created product in storage.
	 * Object structure for HTTP POST
	 * $product = [
	 * 			"createdAt" 		=> [timestamp],
	 * 			"updatedAt" 		=> [timestamp],
	 * 			"feedings" 			=> [object],
	 * 			"treatments" 		=> [object],
	 * 			"product_name" 		=> [string],
	 * 			"unit_size" 		=> [float],
	 * 			"unit_price" 		=> [float],
	 * 			"notes" 			=> [string]
	 * 		];
	 * @return Response
	 */
	public function store()
	{
		$inputs 	= Input::except( '_token' );
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_store( $inputs, 'products' );

		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'products' );
	}
	/**
	 * Update the specified product in storage.
	 * Object structure for HTTP PUT
	 * $product = [
	 * 			"id" 				=> [integer][notnull],
	 * 			"createdAt" 		=> [timestamp],
	 * 			"updatedAt" 		=> [timestamp],
	 * 			"feedings" 			=> [object],
	 * 			"treatments" 		=> [object],
	 * 			"product_name" 		=> [string],
	 * 			"unit_size" 		=> [float],
	 * 			"unit_price" 		=> [float],
	 * 			"notes" 			=> [string]
	 * 		];
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$product 			= Input::except( '_token' );
		$product[ 'id' ]	= (int) $id;
		// Refactored in BeeTools Model
		$response 		= BeeTools::entity_update( $product, 'products' );

		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'products' );
	}
	/**
	 * Remove the specified product from storage.
	 * @param  int  $id
	 * @return Response
	 */
	public function delete( $id )
	{
		// Refactored in BeeTools Model
		$response 	= BeeTools::entity_delete( $id, 'products' );

		// WORK IN PROGRESS
		// return response
		return Redirect::to( 'products' );
	}

}
