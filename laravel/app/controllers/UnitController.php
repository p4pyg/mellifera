<?php
use Vinelab\Http\Client as HttpClient;

class UnitController extends \BaseController
{
    /**
     * Display a listing of the units.
     * @return View units.index with all units
     */
    public function index()
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/units", 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $units 	= $response->json();
        return View::make( 'units.index', [ "units" => $units ] );
    }

    /**
     * Display the specified unit.
     *
     * @param  int  $index
     * @return Response
     */
    public function show($index)
    {
        // Todo
    }
    /**
     * Show the form for creating a new unit.
     * @return View units.form with unit null
     */
    public function create( $apiary_id = null )
    {
        $unit = null;
        $queens = Queen::get();
        $hives  = Hive::get();
        $swarms = Swarm::get();
        return View::make( 'units.form', [ 'unit' => $unit, 'apiary_id' => $apiary_id, 'queens' => $queens, 'hives' => $hives, 'swarms' => $swarms ] );
    }
    /**
     * Show the form for editing the specified unit.
     * @param  int  $index
     * @return View units.form with unit
     */
    public function edit($index)
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/units/" . $index, 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $unit 		= $response->json();
        $queens = Queen::get();
        $hives  = Hive::get();
        $swarms = Swarm::get();
        return View::make( 'units.form', [ 'unit' => $unit, 'queens' => $queens, 'hives' => $hives, 'swarms' => $swarms ] );
    }
    /**
     * Store a newly created unit in storage.
     * Object structure for HTTP POST
     * $unit = [
     * 			"createdAt" 			=> [timestamp],
     * 			"updatedAt" 			=> [timestamp],
     * 			"characteristics" 		=> [object],
     * 			"daugthers" 			=> [object],
     * 			"sons" 					=> [object],
     * 			"files" 				=> [object],
     * 			"productions" 			=> [object],
     * 			"association_date" 		=> [timestamp],
     * 			"separation_date" 		=> [timestamp]
     * 		];
     * @return Response
     */
    public function store()
    {
        $inputs 	= Input::except( '_token', 'apiary_id' );
        $entity = [];
        foreach ( $inputs as $key => $item )
            $entity[$key] = $item === '' ? null : $item;
        $entity = BeeTools::cleanObject( $entity );

        $request = [
            'url'       => Config::get( 'app.api' ) . 'atomic/association',
            'params'    => json_encode( $entity ),
            'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
        ];
        $client     = new HttpClient;
        $response   = $client->post( $request );

        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $apiary = Input::only( 'apiary_id' );
        if( $apiary != '' ){
            $unit = $response->content();
            $unit = json_decode( $unit );
            $transhumance = [ "apiary" => $apiary['apiary_id'], "units" => [ $unit->id ] ];

            $request = [
                'url'       => Config::get( 'app.api' ) . 'atomic/transhumance',
                'params'    => json_encode( $transhumance ),
                'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
            ];
            $client     = new HttpClient;
            $response   = $client->post( $request );

            $view       = BeeTools::is_error( $response );
            if( $view ){
                return $view;
            }
        }

        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'units' );
    }
    /**
     * Update the specified unit in storage.
     * Object structure for HTTP PUT
     * $unit = [
     * 			"id" 					=> [integer][notnull],
     * 			"createdAt" 			=> [timestamp],
     * 			"updatedAt" 			=> [timestamp],
     * 			"characteristics" 		=> [object],
     * 			"daugthers" 			=> [object],
     * 			"sons" 					=> [object],
     * 			"files" 				=> [object],
     * 			"productions" 			=> [object],
     * 			"association_date" 		=> [timestamp],
     * 			"separation_date" 		=> [timestamp]
     * 		];
     * @param  int  $index
     * @return Response
     */
    public function update($index)
    {
        $unit 			= Input::except( '_token' );
        $unit[ 'id' ]	= (int) $index;
        // Refactored in BeeTools Model
        $response 		= BeeTools::entity_update( $unit, 'units' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'units' );
    }
    /**
     * Remove the specified unit from storage.
     * @param  int  $index
     * @return Response
     */
    public function delete($index)
    {
        // Refactored in BeeTools Model
        $response 	= BeeTools::entity_delete( $index, 'units' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'units' );
    }

}
