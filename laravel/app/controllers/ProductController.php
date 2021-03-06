<?php
use Vinelab\Http\Client as HttpClient;

class ProductController extends \BaseController
{
    /**
     * Display a listing of the products.
     * @return View products.index with all products
     */
    public function index()
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/products", 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
        $products 	= $response->json();
        return View::make( 'products.index', [ "products" => $products ] );
    }

    /**
     * Display the specified product.
     *
     * @param  int  $index
     * @return Response
     */
    public function show($index)
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
     * @param  int  $index
     * @return View products.form with product
     */
    public function edit($index)
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/products/" . $index, 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
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
        $response 	= BeeTools::entityStore( $inputs, 'products' );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
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
     * @param  int  $index
     * @return Response
     */
    public function update($index)
    {
        $product 			= Input::except( '_token' );
        $product[ 'id' ]	= (int) $index;
        // Refactored in BeeTools Model
        $response 		= BeeTools::entityUpdate( $product, 'products' );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'products' );
    }
    /**
     * Remove the specified product from storage.
     * @param  int  $index
     * @return Response
     */
    public function delete($index)
    {
        BeeTools::entityDelete( $index, 'products' );
        return Redirect::to( 'products' );
    }

}
