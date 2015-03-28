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
	// Récupération des reines depuis le webservice
	$json_queens = '{ "queens": [{"id": 151, "race": "Mellifera corsica", "age": 1, "geographical_origin": "Bastia", "clipping": "1", "thumbnail": "images/test_reine_1.jpg", "thumbname": "test_reine_1", "current_swarm": 1, "die_date": null, "created_at": "2015-03-25", "updated_at": "2015-03-25", "deleted_at": null }, {"id": 152, "race": "Mellifera Iberica", "age": 3, "geographical_origin": "Alicante", "clipping": "2", "thumbnail": "images/test_reine_1.jpg", "thumbname": "test_reine_2", "current_swarm": 2, "die_date": null, "created_at": "2015-03-25", "updated_at": "2015-03-25", "deleted_at": null },{"id": 153, "race": "Mellifera corsica", "age": 1, "geographical_origin": "Bastia", "clipping": "0", "thumbnail": "images/test_reine_1.jpg", "thumbname": "test_reine_3", "current_swarm": 3, "die_date": "2015-03-27", "created_at": "2015-03-25", "updated_at": "2015-03-27", "deleted_at": null },{"id": 154, "race": "Mellifera corsica", "age": 1, "geographical_origin": "Bastia", "clipping": "0", "thumbnail": "images/test_reine_1.jpg", "thumbname": "test_reine_4", "current_swarm": 4, "die_date": "2015-03-27", "created_at": "2015-03-25", "updated_at": "2015-03-27", "deleted_at": null },{"id": 155, "race": "Mellifera corsica", "age": 1, "geographical_origin": "Bastia", "clipping": "0", "thumbnail": "images/test_reine_1.jpg", "thumbname": "test_reine_5", "current_swarm": 5, "die_date": "2015-03-27", "created_at": "2015-03-25", "updated_at": "2015-03-27", "deleted_at": null },{"id": 156, "race": "Mellifera corsica", "age": 1, "geographical_origin": "Bastia", "clipping": "0", "thumbnail": "images/test_reine_1.jpg", "thumbname": "test_reine_6", "current_swarm": 6, "die_date": "2015-03-27", "created_at": "2015-03-25", "updated_at": "2015-03-27", "deleted_at": null } ] }';
	$json = json_decode( $json_queens ); //!\ Test du decodage json -> tableau d'objets /!\\
	return View::make('queens.index', [ "queens" => $json->queens ] );
} );
Route::get( 'queen/edit/{id?}', function( $id = null )
{
	if( is_null( $id ) )
		$queen = null;
	else
		$queen = json_decode( '{"id": 151, "race": "Mellifera corsica", "age": 1, "geographical_origin": "Bastia", "clipping": "1", "thumbnail": "images/test_reine_1.jpg", "thumbname": "test_reine_1", "current_swarm": 1, "die_date": null, "created_at": "2015-03-25", "updated_at": "2015-03-25", "deleted_at": null }' );
	return View::make('queens.form', [ 'queen' => $queen ] );
} );
Route::get('swarms', function()
{
	return View::make('swarms.index');
} );
