<?php
	use Vinelab\Http\Client as HttpClient;

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

/**
 * Accès landing page
 */
Route::get('/', function()
{
	return View::make('home.landing');
} );

/**
 * Accès back-office
 */
Route::get('backoffice', function()
{
	return Redirect::to('queens');
} );

/**
 * Visualisation des structures JSON pour chaque entité
 */
Route::get( 'structures', function(){
	$entities = [ "apiaries", "beehives", "characteristics", "feedings", "files", "honeysupers", "nuisances", "persons", "products", "productions", "queens", "races", "strengthes", "swarms", "tradetransactions", "treatments", "units", "weathers", "users" ];

	return View::make( 'structures.search', [ 'entities' => $entities ] );
} );


Route::get( 'structures/{param}', [ function( $param){
	$request = [
		'url' 		=> "https://bee-mellifera.herokuapp.com/" . $param,
		'params' 	=> '{}',
		'headers' 	=> ['Content-type: application/json' ]
	];
	$client 	= new HttpClient;
	$response 	= $client->post( $request );
	$structures[ $param ] = $response->json();

	return View::make( 'structures.index', [ 'structures' => $structures ] );

}, 'as' => 'structures.api' ] );


Route::post( 'structures', function(){
	$inputs = Input::all();
	$request = [
		'url' 		=> "https://bee-mellifera.herokuapp.com/" . $inputs['entity'],
		'params' 	=> '{}',
		'headers' 	=> ['Content-type: application/json' ]
	];
	$client 	= new HttpClient;
	$response 	= $client->post( $request );
	$structures[ $inputs['entity'] ] = $response->json();

	return View::make( 'structures.index', [ 'structures' => $structures ] );
} );
// Route::get( 'structures/all', function(){
// 	$entities = [ "apiaries", "beehives", "characteristics", "feedings", "files", "honeysupers", "nuisances", "persons", "products", "productions", "queens", "races", "strengthes", "swarms", "tradetransactions", "treatments", "units", "weathers", "users" ];

// 	$structures = [];
// 	foreach ( $entities as $entity ) {
// 		$request = [
// 			'url' 		=> "https://bee-mellifera.herokuapp.com/" . $entity,
// 			'params' 	=> '{}',
// 			'headers' 	=> ['Content-type: application/json' ]
// 		];
// 		$client 	= new HttpClient;
// 		$response 	= $client->post( $request );
// 		$structures[ $entity ] = $response->json();
// 	}
// 	return View::make( 'structures.index', [ 'structures' => $structures ] );
// } );



/**
 * Gestion des races
 */
Route::get( 'races', 			[ 'uses' => 'RaceController@index', 	'as' => 'races.index' 	] );
Route::get( 'race/edit', 		[ 'uses' => 'RaceController@create', 	'as' => 'races.create' 	] );
Route::get( 'race/edit/{id}', 	[ 'uses' => 'RaceController@edit', 		'as' => 'races.edit' 	] );
Route::post( 'race/edit', 		[ 'uses' => 'RaceController@store', 	'as' => 'races.store' 	] );
Route::post( 'race/edit/{id}', 	[ 'uses' => 'RaceController@update', 	'as' => 'races.update' 	] );
Route::get( 'race/delete/{id}',	[ 'uses' => 'RaceController@delete', 	'as' => 'races.delete' 	] );
/**
 * Gestion des reines
 */
Route::get( 'queens', 			[ 'uses' => 'QueenController@index', 	'as' => 'queens.index' 	] );
Route::get( 'queen/edit', 		[ 'uses' => 'QueenController@create', 	'as' => 'queens.create' ] );
Route::get( 'queen/edit/{id}', 	[ 'uses' => 'QueenController@edit', 	'as' => 'queens.edit' 	] );
Route::post( 'queen/edit', 		[ 'uses' => 'QueenController@store', 	'as' => 'queens.store' 	] );
Route::post( 'queen/edit/{id}', [ 'uses' => 'QueenController@update', 	'as' => 'queens.update' ] );
Route::get( 'queen/delete/{id}',[ 'uses' => 'QueenController@delete', 	'as' => 'queens.delete' ] );

/**
 * Gestion des essaims
 */
Route::get( 'swarms', 			[ 'uses' => 'SwarmController@index', 	'as' => 'swarms.index' 	] );
Route::get( 'swarm/edit', 		[ 'uses' => 'SwarmController@create', 	'as' => 'swarms.create' ] );
Route::get( 'swarm/edit/{id}', 	[ 'uses' => 'SwarmController@edit', 	'as' => 'swarms.edit' 	] );
Route::post( 'swarm/edit', 		[ 'uses' => 'SwarmController@store', 	'as' => 'swarms.store' 	] );
Route::post( 'swarm/edit/{id}', [ 'uses' => 'SwarmController@update', 	'as' => 'swarms.update' ] );
Route::get( 'swarm/delete/{id}',[ 'uses' => 'SwarmController@delete', 	'as' => 'swarms.delete' ] );

/**
 * Gestion des ruches
 */
Route::get( 'hives', 			[ 'uses' => 'HiveController@index', 	'as' => 'hives.index' 	] );
Route::get( 'hive/edit', 		[ 'uses' => 'HiveController@create', 	'as' => 'hives.create' 	] );
Route::get( 'hive/edit/{id}', 	[ 'uses' => 'HiveController@edit', 		'as' => 'hives.edit' 	] );
Route::post( 'hive/edit', 		[ 'uses' => 'HiveController@store', 	'as' => 'hives.store' 	] );
Route::post( 'hive/edit/{id}', 	[ 'uses' => 'HiveController@update', 	'as' => 'hives.update' 	] );
Route::get( 'hive/delete/{id}',	[ 'uses' => 'HiveController@delete', 	'as' => 'hives.delete' 	] );

/**
 * Gestion des ruchers
 */
Route::get( 'apiaries', 			[ 'uses' => 'ApiaryController@index', 	'as' => 'apiaries.index' 	] );
Route::get( 'apiary/edit', 			[ 'uses' => 'ApiaryController@create', 	'as' => 'apiaries.create' 	] );
Route::get( 'apiary/edit/{id}', 	[ 'uses' => 'ApiaryController@edit', 	'as' => 'apiaries.edit' 	] );
Route::post( 'apiary/edit', 		[ 'uses' => 'ApiaryController@store', 	'as' => 'apiaries.store' 	] );
Route::post( 'apiary/edit/{id}', 	[ 'uses' => 'ApiaryController@update', 	'as' => 'apiaries.update' 	] );
Route::get( 'apiary/delete/{id}',	[ 'uses' => 'ApiaryController@delete', 	'as' => 'apiaries.delete' 	] );

/**
 * Gestion des caracteristiques d'une race
 */
Route::get( 'characteristics', 				[ 'uses' => 'CharacteristicController@index', 	'as' => 'characteristics.index' 	] );
Route::get( 'characteristic/edit', 			[ 'uses' => 'CharacteristicController@create', 	'as' => 'characteristics.create' 	] );
Route::get( 'characteristic/edit/{id}', 	[ 'uses' => 'CharacteristicController@edit', 	'as' => 'characteristics.edit' 		] );
Route::post( 'characteristic/edit', 		[ 'uses' => 'CharacteristicController@store', 	'as' => 'characteristics.store' 	] );
Route::post( 'characteristic/edit/{id}', 	[ 'uses' => 'CharacteristicController@update', 	'as' => 'characteristics.update' 	] );
Route::get( 'characteristic/delete/{id}',	[ 'uses' => 'CharacteristicController@delete', 	'as' => 'characteristics.delete' 	] );

/**
 * Gestion des nourrissements
 */
Route::get( 'feedings', 			[ 'uses' => 'FeedingController@index', 	'as' => 'feedings.index' 	] );
Route::get( 'feeding/edit', 		[ 'uses' => 'FeedingController@create', 'as' => 'feedings.create' 	] );
Route::get( 'feeding/edit/{id}', 	[ 'uses' => 'FeedingController@edit', 	'as' => 'feedings.edit' 	] );
Route::post( 'feeding/edit', 		[ 'uses' => 'FeedingController@store', 	'as' => 'feedings.store' 	] );
Route::post( 'feeding/edit/{id}', 	[ 'uses' => 'FeedingController@update', 'as' => 'feedings.update' 	] );
Route::get( 'feeding/delete/{id}',	[ 'uses' => 'FeedingController@delete', 'as' => 'feedings.delete' 	] );

/**
 * Gestion des fichiers
 */
Route::get( 'files', 			[ 'uses' => 'FileController@index', 	'as' => 'files.index' 	] );
Route::get( 'file/edit', 		[ 'uses' => 'FileController@create', 	'as' => 'files.create' 	] );
Route::get( 'file/edit/{id}', 	[ 'uses' => 'FileController@edit', 		'as' => 'files.edit' 	] );
Route::post( 'file/edit', 		[ 'uses' => 'FileController@store', 	'as' => 'files.store' 	] );
Route::post( 'file/edit/{id}', 	[ 'uses' => 'FileController@update', 	'as' => 'files.update' 	] );
Route::get( 'file/delete/{id}',	[ 'uses' => 'FileController@delete', 	'as' => 'files.delete' 	] );

/**
 * Gestion des personnes
 */
Route::get( 'persons', 				[ 'uses' => 'PersonController@index', 	'as' => 'persons.index' 	] );
Route::get( 'person/edit', 			[ 'uses' => 'PersonController@create', 	'as' => 'persons.create' 	] );
Route::get( 'person/edit/{id}', 	[ 'uses' => 'PersonController@edit', 	'as' => 'persons.edit' 		] );
Route::post( 'person/edit', 		[ 'uses' => 'PersonController@store', 	'as' => 'persons.store' 	] );
Route::post( 'person/edit/{id}', 	[ 'uses' => 'PersonController@update', 	'as' => 'persons.update' 	] );
Route::get( 'person/delete/{id}',	[ 'uses' => 'PersonController@delete', 	'as' => 'persons.delete' 	] );

// Nuisance
// Treatment
// Product
// Production
// Strength
// HoneySuper
// TradeTransaction
// Unit
// Weather