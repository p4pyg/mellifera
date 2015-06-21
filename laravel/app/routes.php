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

/************************************************************************** UNIQUEMENT EN PHASE DE DEVELOPPEMENT **************************************************************************/

/**
 * Visualisation des structures JSON pour chaque entité
 */
Route::get('structures', [ function () {
    $entities = [ "apiaries", "beehives", "beehivetypes", "characteristics", "feedings", "files", "honeysupers", "nuisances", "persons", "products", "productions", "queens", "racenames", "races", "strengthes", "swarms", "tradetransactions", "treatments", "units", "weathers", "users" ];

    return View::make('structures.search', [ 'entities' => $entities ]);
} , 'as' => 'structures.list' ]);


Route::get('structures/{param}', [ function ($param) {
    $request = [
        'url'       => Config::get('app.api') . "atomic/" . $param,
        'params'    => '{}',
        'headers'   => ['Content-type: application/json' ]
    ];
    $client     = new HttpClient;
    $response   = $client->post($request);
    $structures[ $param ] = $response->json();

    return View::make('structures.index', [ 'structures' => $structures ]);

}, 'as' => 'structures.api' ]);


Route::post('structures', [ function () {
    $inputs = Input::all();
    $request = [
        'url'       => Config::get('app.api') . "atomic/" . $inputs['entity'],
        'params'    => '{}',
        'headers'   => ['Content-type: application/json' ]
    ];
    $client     = new HttpClient;
    $response   = $client->post($request);
    $structures[ $inputs['entity'] ] = $response->json();

    return View::make('structures.index', [ 'structures' => $structures ]);
}, 'as' => 'structures.search' ]);


/**
 * Insérer de la données pour une colonne dans une table
 */
Route::get('seeds', function () {
    /**
     *   // Type de ruches
     *   $table = 'beehive_types';
     *   $column= 'name';
     *   $datas = [ 'Ronde', 'Bâtisse chaude', 'Bâtisse froide', 'Warré', 'WBC', 'Langstroth', 'Dadant'];
     *
     *   // Espèce d'abeilles
     *   $table = 'race_names';
     *   $column= 'name';
     *   $datas = [ 'Bretonne', 'Corse', 'Cévenole', 'Espagnole', 'Carnica', 'Ligustica', 'Sicula', 'Cecropia', 'Macedonica' ];
     */

    foreach ($datas as $data)
        BeeTools::entity_store([ $column => $data ], $table);

});


/************************************************************************** APPLICATION **************************************************************************/

/**
 * Accès landing page
 */
Route::get('/', [ 'uses' => 'HomeController@landing', 'as' => 'landing.index' ]);


/**
 * Authentification
 */

// Inscription
Route::get('signup',    [ 'uses' => 'UserController@signup',    'as' => 'backoffice.signup' ]);
Route::post('signup',   [ 'uses' => 'UserController@create_owner',  'as' => 'backoffice.create_owner' ]);
// Connexion
Route::get('login',     [ 'uses' => 'UserController@login',     'as' => 'backoffice.login'  ]);
Route::post('signin',   [ 'uses' => 'UserController@signin',    'as' => 'backoffice.signin' ]);
// Déconnexion
Route::get('logout',    [ 'uses' => 'UserController@logout',    'as' => 'backoffice.logout' ]);

/************************************************************************** FILTRE AUTHENTIFICATION **************************************************************************/
Route::filter('auth', function(){

    if (!Auth::check()){
        return Redirect::to('login');
    }


});
/************************************************************************** ACCÈS AUX ENTITÉS **************************************************************************/

Route::group([ "before" => "auth" ], function(){
    /**
     * Accès back-office
     */
    Route::get('backoffice', [ 'uses' => 'HomeController@index', 'as' => 'backoffice.home' ]);
    /**
     * Gestion des ruchers
     */
    Route::get('apiaries',          [ 'uses' => 'ApiaryController@index',   'as' => 'apiaries.index'    ]);
    Route::get('apiary/edit',       [ 'uses' => 'ApiaryController@create',  'as' => 'apiaries.create'   ]);
    Route::get('apiary/edit/{id}',  [ 'uses' => 'ApiaryController@edit',    'as' => 'apiaries.edit'     ]);
    Route::post('apiary/edit',      [ 'uses' => 'ApiaryController@store',   'as' => 'apiaries.store'    ]);
    Route::post('apiary/edit/{id}', [ 'uses' => 'ApiaryController@update',  'as' => 'apiaries.update'   ]);
    Route::get('apiary/delete/{id}',[ 'uses' => 'ApiaryController@delete',  'as' => 'apiaries.delete'   ]);


    /**
     * Gestion des caracteristiques d'une race
     */
    Route::get('characteristics',               [ 'uses' => 'CharacteristicController@index',   'as' => 'characteristics.index'     ]);
    Route::get('characteristic/edit',           [ 'uses' => 'CharacteristicController@create',  'as' => 'characteristics.create'    ]);
    Route::get('characteristic/edit/{id}',      [ 'uses' => 'CharacteristicController@edit',    'as' => 'characteristics.edit'      ]);
    Route::post('characteristic/edit',          [ 'uses' => 'CharacteristicController@store',   'as' => 'characteristics.store'     ]);
    Route::post('characteristic/edit/{id}',     [ 'uses' => 'CharacteristicController@update',  'as' => 'characteristics.update'    ]);
    Route::get('characteristic/delete/{id}',    [ 'uses' => 'CharacteristicController@delete',  'as' => 'characteristics.delete'    ]);

    /**
     * Gestion des nourrissements
     */
    Route::get('feedings',              [ 'uses' => 'FeedingController@index',  'as' => 'feedings.index'    ]);
    Route::get('feeding/edit',          [ 'uses' => 'FeedingController@create', 'as' => 'feedings.create'   ]);
    Route::get('feeding/edit/{id}',     [ 'uses' => 'FeedingController@edit',   'as' => 'feedings.edit'     ]);
    Route::post('feeding/edit',         [ 'uses' => 'FeedingController@store',  'as' => 'feedings.store'    ]);
    Route::post('feeding/edit/{id}',    [ 'uses' => 'FeedingController@update', 'as' => 'feedings.update'   ]);
    Route::get('feeding/delete/{id}',   [ 'uses' => 'FeedingController@delete', 'as' => 'feedings.delete'   ]);

    /**
     * Gestion des fichiers
     */
    Route::get('files',             [ 'uses' => 'FileController@index',     'as' => 'files.index'   ]);
    Route::get('file/edit',         [ 'uses' => 'FileController@create',    'as' => 'files.create'  ]);
    Route::get('file/edit/{id}',    [ 'uses' => 'FileController@edit',      'as' => 'files.edit'    ]);
    Route::post('file/edit',        [ 'uses' => 'FileController@store',     'as' => 'files.store'   ]);
    Route::post('file/edit/{id}',   [ 'uses' => 'FileController@update',    'as' => 'files.update'  ]);
    Route::get('file/delete/{id}',  [ 'uses' => 'FileController@delete',    'as' => 'files.delete'  ]);

    /**
     * Gestion des fichiers
     */
    Route::get('documents',             [ 'uses' => 'DocumentController@index',     'as' => 'documents.index'   ]);
    Route::get('document/edit',         [ 'uses' => 'DocumentController@create',    'as' => 'documents.create'  ]);
    Route::get('document/edit/{id}',    [ 'uses' => 'DocumentController@edit',      'as' => 'documents.edit'    ]);
    Route::post('document/edit',        [ 'uses' => 'DocumentController@store',     'as' => 'documents.store'   ]);
    Route::post('document/edit/{id}',   [ 'uses' => 'DocumentController@update',    'as' => 'documents.update'  ]);
    Route::get('document/delete/{id}',  [ 'uses' => 'DocumentController@delete',    'as' => 'documents.delete'  ]);
    /**
     * Gestion des ruches
     */
    Route::get('hives',             [ 'uses' => 'HiveController@index',     'as' => 'hives.index'       ]);
    Route::get('hive/edit',         [ 'uses' => 'HiveController@create',    'as' => 'hives.create'      ]);
    Route::get('hive/edit/{id}',    [ 'uses' => 'HiveController@edit',      'as' => 'hives.edit'        ]);
    Route::post('hive/edit',        [ 'uses' => 'HiveController@store',     'as' => 'hives.store'       ]);
    Route::post('hive/edit/{id}',   [ 'uses' => 'HiveController@update',    'as' => 'hives.update'      ]);
    Route::get('hive/delete/{id}',  [ 'uses' => 'HiveController@delete',    'as' => 'hives.delete'      ]);
    Route::post('hive/transhumance',[ 'uses' => 'HiveController@transhume', 'as' => 'hives.transhume'   ]);

    /**
     * Gestion des honeysuper
     */
    Route::get('honeysupers',               [ 'uses' => 'HoneySuperController@index',   'as' => 'honeysupers.index' ]);
    Route::get('honeysuper/edit',           [ 'uses' => 'HoneySuperController@create',  'as' => 'honeysupers.create']);
    Route::get('honeysuper/edit/{id}',      [ 'uses' => 'HoneySuperController@edit',    'as' => 'honeysupers.edit'  ]);
    Route::post('honeysuper/edit',          [ 'uses' => 'HoneySuperController@store',   'as' => 'honeysupers.store' ]);
    Route::post('honeysuper/edit/{id}',     [ 'uses' => 'HoneySuperController@update',  'as' => 'honeysupers.update']);
    Route::get('honeysuper/delete/{id}',    [ 'uses' => 'HoneySuperController@delete',  'as' => 'honeysupers.delete']);

    /**
     * Gestion des nuisances
     */
    Route::get('nuisances',             [ 'uses' => 'NuisanceController@index', 'as' => 'nuisances.index'   ]);
    Route::get('nuisance/edit',         [ 'uses' => 'NuisanceController@create','as' => 'nuisances.create'  ]);
    Route::get('nuisance/edit/{id}',    [ 'uses' => 'NuisanceController@edit',  'as' => 'nuisances.edit'    ]);
    Route::post('nuisance/edit',        [ 'uses' => 'NuisanceController@store', 'as' => 'nuisances.store'   ]);
    Route::post('nuisance/edit/{id}',   [ 'uses' => 'NuisanceController@update','as' => 'nuisances.update'  ]);
    Route::get('nuisance/delete/{id}',  [ 'uses' => 'NuisanceController@delete','as' => 'nuisances.delete'  ]);

    /**
     * Gestion des personnes
     */
    Route::get('persons',               [ 'uses' => 'PersonController@index',   'as' => 'persons.index'     ]);
    Route::get('person/edit',           [ 'uses' => 'PersonController@create',  'as' => 'persons.create'    ]);
    Route::get('person/edit/{id}',      [ 'uses' => 'PersonController@edit',    'as' => 'persons.edit'      ]);
    Route::post('person/edit',          [ 'uses' => 'PersonController@store',   'as' => 'persons.store'     ]);
    Route::post('person/edit/{id}',     [ 'uses' => 'PersonController@update',  'as' => 'persons.update'    ]);
    Route::get('person/delete/{id}',    [ 'uses' => 'PersonController@delete',  'as' => 'persons.delete'    ]);
    /**
     * Gestion des utilisateurs
     */
    Route::get('users',                 [ 'uses' => 'UserController@index',     'as' => 'users.index'   ]);
    Route::get('user/edit',             [ 'uses' => 'UserController@create',    'as' => 'users.create'  ]);
    Route::get('user/edit/{id}',        [ 'uses' => 'UserController@edit',      'as' => 'users.edit'    ]);
    Route::post('user/edit',            [ 'uses' => 'UserController@store',     'as' => 'users.store'   ]);
    Route::post('user/edit/{id}',       [ 'uses' => 'UserController@update',    'as' => 'users.update'  ]);
    Route::get('user/delete/{id}',      [ 'uses' => 'UserController@delete',    'as' => 'users.delete'  ]);

    /**
     * Gestion des produits
     */
    Route::get('products',              [ 'uses' => 'ProductController@index',  'as' => 'products.index'    ]);
    Route::get('product/edit',          [ 'uses' => 'ProductController@create', 'as' => 'products.create'   ]);
    Route::get('product/edit/{id}',     [ 'uses' => 'ProductController@edit',   'as' => 'products.edit'     ]);
    Route::post('product/edit',         [ 'uses' => 'ProductController@store',  'as' => 'products.store'    ]);
    Route::post('product/edit/{id}',    [ 'uses' => 'ProductController@update', 'as' => 'products.update'   ]);
    Route::get('product/delete/{id}',   [ 'uses' => 'ProductController@delete', 'as' => 'products.delete'   ]);

    /**
     * Gestion des productions
     */
    Route::get('productions',               [ 'uses' => 'ProductionController@index',   'as' => 'productions.index'     ]);
    Route::get('production/edit',           [ 'uses' => 'ProductionController@create',  'as' => 'productions.create'    ]);
    Route::get('production/edit/{id}',      [ 'uses' => 'ProductionController@edit',    'as' => 'productions.edit'      ]);
    Route::post('production/edit',          [ 'uses' => 'ProductionController@store',   'as' => 'productions.store'     ]);
    Route::post('production/edit/{id}',     [ 'uses' => 'ProductionController@update',  'as' => 'productions.update'    ]);
    Route::get('production/delete/{id}',    [ 'uses' => 'ProductionController@delete',  'as' => 'productions.delete'    ]);

    /**
     * Gestion des reines
     */
    Route::get('queens',            [ 'uses' => 'QueenController@index',    'as' => 'queens.index'      ]);
    Route::get('queen/edit',        [ 'uses' => 'QueenController@create',   'as' => 'queens.create'     ]);
    Route::get('queen/edit/{id}',   [ 'uses' => 'QueenController@edit',     'as' => 'queens.edit'       ]);
    Route::post('queen/edit',       [ 'uses' => 'QueenController@store',    'as' => 'queens.store'      ]);
    Route::post('queen/edit/{id}',  [ 'uses' => 'QueenController@update',   'as' => 'queens.update'     ]);
    Route::get('queen/delete/{id}', [ 'uses' => 'QueenController@delete',   'as' => 'queens.delete'     ]);
    Route::get('queen/show/{id}',   [ 'uses' => 'QueenController@show',     'as' => 'queens.show'       ]);
    Route::post('queen/transfert',  [ 'uses' => 'QueenController@transfert','as' => 'queens.transfert'  ]);

    /**
     * Gestion des races
     */
    Route::get('races',             [ 'uses' => 'RaceController@index',     'as' => 'races.index'   ]);
    Route::get('race/edit',         [ 'uses' => 'RaceController@create',    'as' => 'races.create'  ]);
    Route::get('race/edit/{id}',    [ 'uses' => 'RaceController@edit',      'as' => 'races.edit'    ]);
    Route::post('race/edit',        [ 'uses' => 'RaceController@store',     'as' => 'races.store'   ]);
    Route::post('race/edit/{id}',   [ 'uses' => 'RaceController@update',    'as' => 'races.update'  ]);
    Route::get('race/delete/{id}',  [ 'uses' => 'RaceController@delete',    'as' => 'races.delete'  ]);

    /**
     * Gestion des strengthe
     */
    Route::get('strenghtes',            [ 'uses' => 'StrengtheController@index',    'as' => 'strenghtes.index'  ]);
    Route::get('strengthe/edit',        [ 'uses' => 'StrengtheController@create',   'as' => 'strenghtes.create' ]);
    Route::get('strengthe/edit/{id}',   [ 'uses' => 'StrengtheController@edit',     'as' => 'strenghtes.edit'   ]);
    Route::post('strengthe/edit',       [ 'uses' => 'StrengtheController@store',    'as' => 'strenghtes.store'  ]);
    Route::post('strengthe/edit/{id}',  [ 'uses' => 'StrengtheController@update',   'as' => 'strenghtes.update' ]);
    Route::get('strengthe/delete/{id}', [ 'uses' => 'StrengtheController@delete',   'as' => 'strenghtes.delete' ]);

    /**
     * Gestion des essaims
     */
    Route::get('swarms',           [ 'uses' => 'SwarmController@index',    'as' => 'swarms.index'       ]);
    Route::get('swarm/edit',       [ 'uses' => 'SwarmController@create',   'as' => 'swarms.create'      ]);
    Route::get('swarm/edit/{id}',  [ 'uses' => 'SwarmController@edit',     'as' => 'swarms.edit'        ]);
    Route::post('swarm/edit',      [ 'uses' => 'SwarmController@store',    'as' => 'swarms.store'       ]);
    Route::post('swarm/edit/{id}', [ 'uses' => 'SwarmController@update',   'as' => 'swarms.update'      ]);
    Route::get('swarm/delete/{id}',[ 'uses' => 'SwarmController@delete',   'as' => 'swarms.delete'      ]);
    Route::post('swarm/transfert', [ 'uses' => 'SwarmController@transfert','as' => 'swarms.transfert'   ]);

    /**
     * Gestion des transactions
     */
    Route::get('tradetransactions',             [ 'uses' => 'TradeTransactionController@index',     'as' => 'tradetransactions.index'   ]);
    Route::get('tradetransaction/edit',         [ 'uses' => 'TradeTransactionController@create',    'as' => 'tradetransactions.create'  ]);
    Route::get('tradetransaction/edit/{id}',    [ 'uses' => 'TradeTransactionController@edit',      'as' => 'tradetransactions.edit'    ]);
    Route::post('tradetransaction/edit',        [ 'uses' => 'TradeTransactionController@store',     'as' => 'tradetransactions.store'   ]);
    Route::post('tradetransaction/edit/{id}',   [ 'uses' => 'TradeTransactionController@update',    'as' => 'tradetransactions.update'  ]);
    Route::get('tradetransaction/delete/{id}',  [ 'uses' => 'TradeTransactionController@delete',    'as' => 'tradetransactions.delete'  ]);

    /**
     * Gestion des traitements
     */
    Route::get('treatments',            [ 'uses' => 'TreatmentController@index',    'as' => 'treatments.index'  ]);
    Route::get('treatment/edit',        [ 'uses' => 'TreatmentController@create',   'as' => 'treatments.create' ]);
    Route::get('treatment/edit/{id}',   [ 'uses' => 'TreatmentController@edit',     'as' => 'treatments.edit'   ]);
    Route::post('treatment/edit',       [ 'uses' => 'TreatmentController@store',    'as' => 'treatments.store'  ]);
    Route::post('treatment/edit/{id}',  [ 'uses' => 'TreatmentController@update',   'as' => 'treatments.update' ]);
    Route::get('treatment/delete/{id}', [ 'uses' => 'TreatmentController@delete',   'as' => 'treatments.delete' ]);

    /**
     * Gestion des unités
     */
    Route::get('units',                 [ 'uses' => 'UnitController@index',     'as' => 'units.index'   ]);
    Route::get('unit/edit',             [ 'uses' => 'UnitController@create',    'as' => 'units.create'  ]);
    Route::get('unit/new/apiary/{id}',  [ 'uses' => 'UnitController@create',    'as' => 'units.create'  ]);
    Route::get('unit/edit/{id}',        [ 'uses' => 'UnitController@edit',      'as' => 'units.edit'    ]);
    Route::post('unit/edit',            [ 'uses' => 'UnitController@store',     'as' => 'units.store'   ]);
    Route::post('unit/edit/{id}',       [ 'uses' => 'UnitController@update',    'as' => 'units.update'  ]);
    Route::get('unit/delete/{id}',      [ 'uses' => 'UnitController@delete',    'as' => 'units.delete'  ]);

});
