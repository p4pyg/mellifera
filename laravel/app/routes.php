<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('queens.index');
} );
Route::get('queens', function()
{

	/**
	 * Structure retournée par le webservice
	 * [{
	 * 	"id":201,
	 * 	"transaction":null,
	 * 	"unit":null,
	 * 	"race": {"id":161,"characteristics":null,"geographical_origin":"Tolède","life_span":4,"race_name":"iberica douce"},
	 * 	"birth_date":null,
	 * 	"death_date":null,
	 * 	"clipping":true
	 * }]
	 * {
	 * 	"id":301,
	 * 	"transaction":null,
	 * 	"unit":null,
	 * 	"race": {"id":161,"characteristics":null,"geographical_origin":"Tol\u00e8de","life_span":4,"race_name":"iberica douce"},
	 * 	"birth_date":null,
	 * 	"death_date":null,
	 * 	"clipping":"2"
	 * 	}
	 */
	$json_queens 	= file_get_contents( "https://bee-mellifera.herokuapp.com/Queen" );
	$json 			= json_decode( $json_queens );
	return View::make('queens.index', [ "queens" => $json ] );
} );
Route::get( 'queen/edit/{id?}', function( $id = null )
{
	if( is_null( $id ) )
		$queen = null;
	else{
		$json_queen = file_get_contents( "https://bee-mellifera.herokuapp.com/Queen/" . $id );
		$queen 		= json_decode( $json_queen );
	}
	return View::make('queens.form', [ 'queen' => $queen ] );
} );
Route::get('swarms', function()
{
	return View::make('swarms.index');
} );
Route::post( 'queen/edit/{id?}', function( $id = null ){
	$inputs 		= Input::except( '_token' );
	$race 			= [ "id" => 161, "characteristics" => null, "geographical_origin" => $inputs['geographical_origin' ], "life_span" => 4, "race_name" => $inputs['race'] ];
	$queen 			= [ "id" => (int) $id, 	"transaction" => null, "unit" => null, "race" => $race, "birth_date" => null, "death_date" => null, "clipping" => $inputs['clipping'] ];
	$url 			= "https://bee-mellifera.herokuapp.com/Queen";
	$data_json 		= json_encode( $queen );

			echo '<pre>';
			print_r( $data_json );
			echo '</pre>';
			die('<p style="color:orange; font-weight:bold;">Raison</p>');


	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response  = curl_exec($ch);
	curl_close($ch);



	echo '<pre>';
	print_r($response);
	echo '</pre>';
	die('<p style="color:orange; font-weight:bold;">Raison</p>');




} );
