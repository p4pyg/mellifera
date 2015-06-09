<?php
use Vinelab\Http\Client as HttpClient;

class RaceController extends BaseController
{
    /**
     * Display races list
     * @return  View races.index with all races
     */
    public function index()
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/races", 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $races 		= $response->json();
        return View::make( 'races.index', [ "races" => $races ] );
    }
    /**
     * Display the specified race.
     *
     * @param  int  $index
     * @return Response
     */
    public function show($index)
    {
        // Todo
    }
    /**
     * Show the form for creating a new race.
     * @return View races.form with race null
     */
    public function create()
    {
        $race = null;
        return View::make( 'races.form', [ 'race' => $race ] );
    }
    /**
     * Show the form for editing the specified race.
     * @param  int  $index
     * @return View races.form with race
     */
    public function edit($index)
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/races/" . $index, 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view       = BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $race       = $response->json();

// echo '<pre>';
// print_r($response);
// echo '</pre>';
// die('<p style="color:orange; font-weight:bold;">Raison</p>');
        $response   = $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/characteristics/" . $race->characteristic->id, 'headers'  => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view       = BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $characteristic  = $response->json();
        return View::make( 'races.form', [ 'race' => $race, 'characteristic' => $characteristic ] );
    }
    /**
     * Store a newly created race in storage.
     * Object structure for HTTP POST
     * $race = [
     * 			"characteristics" 		=> [object],
     * 			"geographical_origin" 	=> [string],
     * 			"life_span" 			=> [integer],
     * 			"race_name" 			=> [string]
     * 		];
     * @return Response
     */
    public function store()
    {
        $inputs = Input::except( '_token', 'characteristic_id');
        $race 	= Input::except( '_token', 'characteristic_id', 'characteristic_date', 'characteristic_racial_type', 'characteristic_aggressivness_level', 'characteristic_swarming_level', 'characteristic_winter_hardiness_level', 'characteristic_wake_up_month', 'characteristic_comment' );

        $names          = BeeTools::get_arraylist( 'races', 'name', false, true );
        $race_name_id   = array_search( $race[ 'name' ] , $names );
        $race_name      = $race[ 'name' ];
        $race['name']   = [ 'name' => $race_name ];


        $characteristics = [];
        foreach ( $inputs as $key => $input )
            if( str_contains( $key, 'characteristic_' ) )
                $characteristics[ str_replace( 'characteristic_', '', $key ) ] = $input;

        $characteristics_race_name_id   = array_search( $characteristics[ 'racial_type' ] , $names );
        $characteristics_race_name      = $characteristics[ 'racial_type' ];
        $characteristics['racial_type'] = null;//[ 'name' => $characteristics_race_name ];

        $characteristics[ 'date' ] 	= date( 'Y-m-d', strtotime( $characteristics[ 'date' ] ) );

        // Refactored in BeeTools Model
        $response_characteristic 	= BeeTools::entity_store( $characteristics, 'characteristics' );
        $view 		= BeeTools::is_error( $response_characteristic );
        if( $view ){
            return $view;
        }
        $race['characteristic'] 	= $response_characteristic;
        // Refactored in BeeTools Model
        $response_race 	= BeeTools::entity_store( $race, 'races' );
        $view 		    = BeeTools::is_error( $response_race );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'races' );
    }
    /**
     * Update the specified race in storage.
     * Object structure for HTTP PUT
     * $race = [
     * 			"id" 					=> [integer][notnull],
     * 			"characteristics" 		=> [object],
     * 			"geographical_origin" 	=> [string],
     * 			"life_span" 			=> [integer],
     * 			"race_name" 			=> [string]
     * 		];
     * @param  int  $index
     * @return Response
     */
    public function update($index)
    {
        $inputs = Input::except( '_token' );
        $race 	= Input::except( '_token', 'characteristic_id', 'characteristic_date', 'characteristic_racial_type', 'characteristic_aggressivness_level', 'characteristic_swarming_level', 'characteristic_winter_hardiness_level', 'characteristic_wake_up_month', 'characteristic_comment' );


        $characteristics = [];
        foreach ( $inputs as $key => $input )
            if( str_contains( $key, 'characteristic_' ) )
                $characteristics[ str_replace( 'characteristic_', '', $key ) ] = $input;

        $characteristics[ 'date' ] 	= date( 'Y-m-d', strtotime( $characteristics[ 'date' ] ) );
        if( $characteristics['id'] == '' ){
            unset( $characteristics['id'] );
            $response_characteristic 	= BeeTools::entity_store( $characteristics, 'characteristics' );
        } else
            $response_characteristic 	= BeeTools::entity_update( $characteristics, 'characteristics' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $race[ 'id' ] 	= (int) $index;
        $race['characteristics'] 	= $response_characteristic;
        // Refactored in BeeTools Model
        $response 		= BeeTools::entity_update( $race, 'races' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }

        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'races' );
    }
    /**
     * Remove the specified race from storage.
     * @param  int  $index
     * @return Response
     */
    public function delete($index)
    {
        // Refactored in BeeTools Model
        $response 	= BeeTools::entity_delete( $index, 'races' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'races' );
    }
}
