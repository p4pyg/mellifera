<?php
use Vinelab\Http\Client as HttpClient;

class HiveController extends \BaseController
{
    /**
     * Display a listing of the hives.
     * @return View hives.index with all hives
     */
    public function index()
    {
        $client     = new HttpClient;
        $response   = $client->get( [
                                        'url' => Config::get( 'app.api' ) . "atomic/beehives",
                                        'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                    ] );
        $view       = BeeTools::is_error( $response );
        if( $view ) return $view;

        $hives      = Hive::getHivesApiarie( $response->json() );
        $apiaries   = Apiary::get();
        foreach ($apiaries as $key => $apiary) {
            if ($apiary->hives_capacity == count($apiary->productions)){
                unset($apiaries[$key]);
            }
        }

        return View::make( 'hives.index', [ "hives" => $hives, 'apiaries' => $apiaries ] );
    }

    /**
     * Display the specified hive.
     *
     * @param  int  $index
     * @return Response
     */
    public function show($index)
    {
        // Todo
    }
    /**
     * Show the form for creating a new hive.
     * @return View hives.form with hive null
     */
    public function create()
    {
        $hive = null;
        return View::make( 'hives.form', [ 'hive' => $hive ] );
    }
    /**
     * Show the form for editing the specified hive.
     * @param  int  $index
     * @return View hives.form with hive
     */
    public function edit($index)
    {
        $client     = new HttpClient;
        $response   = $client->get( [
                                        'url' => Config::get( 'app.api' ) . "atomic/beehives/" . $index,
                                        'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                    ] );
        $view       = BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $hive       = $response->json();
        return View::make( 'hives.form', [ 'hive' => $hive ] );
    }
    /**
     * Store a newly created hive in storage.
     * Object structure for HTTP POST
     * $hive = [
     *      "createdAt"         => [timestamp],
     *      "updatedAt"         => [timestamp],
     *      "trades"            => [object],
     *      "units"             => [object],
     *      "id_lot"            => [integer],
     *      "beehive_type"      => [string],
     *      "number_of_frames"  => [integer],
     *      "number_of_rocks"   => [integer],
     *      "notes"             => [string]
     *      ];
     * @return Response
     */
    public function store()
    {
        $inputs     = Input::except( '_token' );
        // Récupération de la collection des identifiants de beehive_types
        $types = BeeTools::get_arraylist( 'beehives', 'type', false, true );

        $type_id    = array_search( $inputs[ 'type' ] , $types );
        $type_name  = $inputs[ 'type' ];

        $inputs['type'] = [ 'name' => $type_name ];
        // Refactored in BeeTools Model
        $response       = BeeTools::entity_store( $inputs, 'beehives' );
        $view           = BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        return Redirect::to( 'hives' );
    }
    /**
     * Update the specified hive in storage.
     * Object structure for HTTP PUT
     * $hive = [
     *      "id"                => [integer][notnull],
     *      "createdAt"         => [timestamp],
     *      "updatedAt"         => [timestamp],
     *      "trades"            => [object],
     *      "units"             => [object],
     *      "id_lot"            => [integer],
     *      "beehive_type"      => [string],
     *      "number_of_frames"  => [integer],
     *      "number_of_rocks"   => [integer],
     *      "notes"             => [string]
     *      ];
     * @param  int  $index
     * @return Redirect
     */
    public function update($index)
    {
        $hive           = Input::except( '_token' );
        $hive[ 'id' ]   = (int)$index;
        // Récupération de la collection des identifiants de beehive_types
        $types = BeeTools::get_arraylist( 'beehives', 'type', false, true );

        $type_id    = array_search( $hive[ 'type' ] , $types );
        $type_name  = $hive[ 'type' ];

        $hive['type'] = [ 'name' => $type_name ];

        $response       = BeeTools::entity_update( $hive, 'beehives' );
        $view       = BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        return Redirect::to( 'hives' );
    }
    /**
     * Remove the specified hive from storage.
     * @param  int  $index
     * @return Redirect
     */
    public function delete($index)
    {
        $response   = BeeTools::entity_delete( $index, 'beehives' );
        return Redirect::to( 'hives' );
    }

    /**
     * Déplacer ou affecter une ruche à un rucher
     * @return  Redirect
     */
    public function transhume()
    {
        $inputs = Input::only('apiary','hive');

        $hive = Hive::get($inputs['hive']);

        if (empty($hive->units)) {
            $request = [
                        'url'       => Config::get('app.api') . 'atomic/association',
                        'params'    => json_encode(['beehive' => $hive->id]),
                        'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get('api_token') ]
                    ];
            $client     = new HttpClient;
            $response   = $client->post($request);
            $unit       = $response->json();
        } else {
            $unit       = Unit::get($hive->units[0]->id);
        }
        $request = [
                    'url'       => Config::get('app.api') . 'atomic/transhumance',
                    'params'    => json_encode(['apiary' => $inputs['apiary'], 'units' => [$unit->id]]),
                    'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get('api_token') ]
                ];
        $client     = new HttpClient;
        $response   = $client->post($request);
        $production = $response->json();

        return Redirect::back();
    }
}
