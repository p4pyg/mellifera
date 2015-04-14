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
 * Gestion des races
 */
Route::get( 'races', 				[ 'uses' => 'RaceController@index', 	'as' => 'races.index' 	] );
Route::get( 'race/edit', 			[ 'uses' => 'RaceController@create', 	'as' => 'races.create' 	] );
Route::get( 'race/edit/{id}', 		[ 'uses' => 'RaceController@edit', 		'as' => 'races.edit' 	] );
Route::post( 'race/edit', 			[ 'uses' => 'RaceController@store', 	'as' => 'races.store' 	] );
Route::post( 'race/edit/{id}', 		[ 'uses' => 'RaceController@update', 	'as' => 'races.update' 	] );
Route::post( 'race/delete/{id}',	[ 'uses' => 'RaceController@delete', 	'as' => 'races.delete' 	] );
/**
 * Gestion des reines
 */
Route::get( 'queens', 				[ 'uses' => 'QueenController@index', 	'as' => 'queens.index' 	] );
Route::get( 'queen/edit', 			[ 'uses' => 'QueenController@create', 	'as' => 'queens.create' ] );
Route::get( 'queen/edit/{id}', 		[ 'uses' => 'QueenController@edit', 	'as' => 'queens.edit' 	] );
Route::post( 'queen/edit', 			[ 'uses' => 'QueenController@store', 	'as' => 'queens.store' 	] );
Route::post( 'queen/edit/{id}', 	[ 'uses' => 'QueenController@update', 	'as' => 'queens.update' ] );
Route::post( 'queen/delete/{id}',	[ 'uses' => 'QueenController@delete', 	'as' => 'queens.delete' ] );

/**
 * Gestion des essaims
 */
Route::get( 'swarms', 				[ 'uses' => 'SwarmController@index', 	'as' => 'swarms.index' 	] );
Route::get( 'swarm/edit', 			[ 'uses' => 'SwarmController@create', 	'as' => 'swarms.create' ] );
Route::get( 'swarm/edit/{id}', 		[ 'uses' => 'SwarmController@edit', 	'as' => 'swarms.edit' 	] );
Route::post( 'swarm/edit', 			[ 'uses' => 'SwarmController@store', 	'as' => 'swarms.store' 	] );
Route::post( 'swarm/edit/{id}', 	[ 'uses' => 'SwarmController@update', 	'as' => 'swarms.update' ] );
Route::post( 'swarm/delete/{id}',	[ 'uses' => 'SwarmController@delete', 	'as' => 'swarms.delete' ] );

/**
 * Gestion des ruches
 */
Route::get( 'hives', 				[ 'uses' => 'HiveController@index', 	'as' => 'hives.index' 	] );
Route::get( 'hive/edit', 			[ 'uses' => 'HiveController@create', 	'as' => 'hives.create' 	] );
Route::get( 'hive/edit/{id}', 		[ 'uses' => 'HiveController@edit', 		'as' => 'hives.edit' 	] );
Route::post( 'hive/edit', 			[ 'uses' => 'HiveController@store', 	'as' => 'hives.store' 	] );
Route::post( 'hive/edit/{id}', 		[ 'uses' => 'HiveController@update', 	'as' => 'hives.update' 	] );
Route::post( 'hive/delete/{id}',	[ 'uses' => 'HiveController@delete', 	'as' => 'hives.delete' 	] );

/**
 * Gestion des ruchers
 */
Route::get( 'apiaries', 			[ 'uses' => 'ApiaryController@index', 	'as' => 'apiaries.index' 	] );
Route::get( 'apiary/edit', 			[ 'uses' => 'ApiaryController@create', 	'as' => 'apiaries.create' 	] );
Route::get( 'apiary/edit/{id}', 	[ 'uses' => 'ApiaryController@edit', 	'as' => 'apiaries.edit' 	] );
Route::post( 'apiary/edit', 		[ 'uses' => 'ApiaryController@store', 	'as' => 'apiaries.store' 	] );
Route::post( 'apiary/edit/{id}', 	[ 'uses' => 'ApiaryController@update', 	'as' => 'apiaries.update' 	] );
Route::post( 'apiary/delete/{id}',	[ 'uses' => 'ApiaryController@delete', 	'as' => 'apiaries.delete' 	] );