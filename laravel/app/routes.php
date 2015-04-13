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
	return View::make('home.landing');
} );
Route::get('backoffice', function()
{
	return Redirect::to('queens');
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
	 * 	Tests 05/04
	 * 	FAIL : {"id":301,"transaction":null,"unit":null,"race":{"id":161,"characteristics":null,"geographical_origin":"Tol\u00e8de","life_span":4,"race_name":"iberica douce"},"birth_date":null,"death_date":null,"clipping":0}
	 * 	FAIL : {"id":301,"transaction":null,"unit":null,"race":{"id":161},"birth_date":null,"death_date":null,"clipping":0}
	 *  Tests 06/04
	 *  FAIL : {"id":301,"transaction":null,"unit":null,"race":{"id":161},"birth_date":null,"death_date":null,"clipping": true}
	 */
	$json_queens 	= file_get_contents( "https://bee-mellifera.herokuapp.com/Queen" );
	$queens 		= json_decode( $json_queens );
	return View::make('queens.index', [ "queens" => $queens ] );
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
Route::post( 'queen/edit/{id?}', function( $id = null ){
	$inputs 		= Input::except( '_token' );
	$race 			= [ "id" => 161 , "characteristics" => null, "geographical_origin" => $inputs['geographical_origin' ], "life_span" => 4, "race_name" => $inputs['race'] ];
	$queen 			= [ "id" => (int) $id, 	"transaction" => null, "unit" => null, "race" => $race, "birth_date" => "2015-04-01", "death_date" => null, "clipping" => (bool)$inputs['clipping'] ];

	$url 			= "https://bee-mellifera.herokuapp.com/Queen";
	$data_json 		= json_encode( $queen );


	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, [ 'Content-Type: application/json' ] );
	curl_setopt( $ch, CURLOPT_POST, 1 );
	curl_setopt( $ch, CURLOPT_FAILONERROR, 1 );
	curl_setopt( $ch, CURLOPT_HEADER, 1);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $data_json );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$response  = curl_exec( $ch );
	curl_close( $ch );

	echo '<pre>';
	print_r( $response );
	echo '</pre>';
	die('<p style="color:orange; font-weight:bold;">Raison</p>');

	if ( $response ) {
		$error 	= "";
	}else{
		$queen 	= json_decode( $response );
	}
} );

/**
 * Gestion des essaims
 */
Route::get('swarms', function()
{
	return View::make('swarms.index');
} );


/**
 * Gestion des ruches
 */

/**
 * Accès à la liste des ruches
 * @return  View List
 */
Route::get('hives', function(){
	$json_hives	= file_get_contents( "https://bee-mellifera.herokuapp.com/BeeHive" );
	$hives 			= json_decode( $json_hives );
	return View::make('hives.index', [ "hives" => $hives ] );
} );








/**
 * Gestion des races
 */

/**
 * Accès à la liste des races
 * @return  View List
 */
Route::get('races', function(){
	$json_races 	= file_get_contents( "https://bee-mellifera.herokuapp.com/Race" );
	$races 			= json_decode( $json_races );
	return View::make('races.index', [ "races" => $races ] );
} );

/**
 * Accès au formulaire de création/édition/suppression de race
 * @param integer identifiant de la race
 * @return view Formulaire
 */
Route::get( 'race/edit/{id?}', function( $id = null )
{
	if( is_null( $id ) )
		$race = null;
	else{
		$json_race = file_get_contents( "https://bee-mellifera.herokuapp.com/Race/" . $id );
		$race 		= json_decode( $json_race );
	}
	return View::make('races.form', [ 'race' => $race ] );
} );

/**
 * Enregistrement du formulaire
 * @param integer identifiant de la race (optionnel)
 * @return  Error|Success
 */
Route::post( 'race/edit/{id?}', [ function( $id = null )
{
	$inputs 		= Input::except( '_token' );
	$race 			= [ "id" => 161 , "characteristics" => null, "geographical_origin" => $inputs['geographical_origin' ], "life_span" => $inputs['life_span' ], "race_name" => $inputs['race_name'] ];

	$url 			= "https://bee-mellifera.herokuapp.com/Race";
	$data_json 		= json_encode( $race );

	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, [ 'Content-Type: application/json' ] );
	curl_setopt( $ch, CURLOPT_POST, 1 );
	curl_setopt( $ch, CURLOPT_FAILONERROR, 1 );
	curl_setopt( $ch, CURLOPT_HEADER, 1);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $data_json );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$response  = curl_exec( $ch );
	curl_close( $ch );

	if ( $response ) {
		$error 	= "";
	}else{
		$race 	= json_decode( $response );
	}
	echo '<pre>';
	print_r( $response );
	echo '</pre>';
	die('<p style="color:orange; font-weight:bold;">Raison</p>');
}, 'as' => 'form.race' ] );