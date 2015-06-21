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
        $client     = new HttpClient;
        $response   = $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/races", 'headers'     => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view       = BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
        $races      = $response->json();
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
        $client     = new HttpClient;
        $response   = $client->get( [
                                    'url' => Config::get( 'app.api' ) . "atomic/races/" . $index,
                                    'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                ] );
        $view       = BeeTools::isError( $response );
        if( $view ) return $view;

        $race       = $response->json();

        if( ! is_null( $race->characteristic ) ){
            $response   = $client->get( [
                                        'url' => Config::get( 'app.api' ) . "atomic/characteristics/" . $race->characteristic->id,
                                        'headers'  => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                    ] );
            $characteristic  = $response->json();
        }else
            $characteristic  = null;
        return View::make( 'races.form', [ 'race' => $race, 'characteristic' => $characteristic ] );
    }
    /**
     * Store a newly created race in storage.
     * Object structure for HTTP POST
     * $race = [
     *          "characteristics"       => [object],
     *          "geographical_origin"   => [string],
     *          "life_span"             => [integer],
     *          "race_name"             => [string]
     *      ];
     * @return Response
     */
    public function store()
    {
        $inputs = Input::except( '_token', 'characteristic_id');
        $race   = Input::except( '_token', 'characteristic_id', 'characteristic_date', 'characteristic_racial_type', 'characteristic_aggressivness_level', 'characteristic_swarming_level', 'characteristic_winter_hardiness_level', 'characteristic_wake_up_month', 'characteristic_comment' );

        $race['name']   = [ 'name' => $race[ 'name' ] ]; // dans l'attente de modification ws $race_name

        $characteristics = [];
        foreach ( $inputs as $key => $input )
            if( str_contains( $key, 'characteristic_' ) )
                $characteristics[ str_replace( 'characteristic_', '', $key ) ] = $input;

        $characteristics['racial_type'] = null;// dans l'attente de modification ws $characteristics_race_name

        $characteristics[ 'date' ]  = date( 'Y-m-d', strtotime( $characteristics[ 'date' ] ) );

        $response_characteristic    = BeeTools::entityStore( $characteristics, 'characteristics' );
        $view       = BeeTools::isError( $response_characteristic );
        if( $view ) return $view;

        $race['characteristic']     = $response_characteristic;

        $race           = BeeTools::cleanElement( $race );
        $response_race  = BeeTools::entityStore( $race, 'races' );
        $view           = BeeTools::isError( $response_race );
        if( $view ) return $view;

        return Redirect::to( 'races' );
    }
    /**
     * Update the specified race in storage.
     * Object structure for HTTP PUT
     * $race = [
     *          "id"                    => [integer][notnull],
     *          "characteristics"       => [object],
     *          "geographical_origin"   => [string],
     *          "life_span"             => [integer],
     *          "race_name"             => [string]
     *      ];
     * @param  int  $index
     * @return Response
     */
    public function update($index)
    {
        $inputs = Input::except( '_token' );
        $race   = Input::except( '_token', 'characteristic_id', 'characteristic_date', 'characteristic_racial_type', 'characteristic_aggressivness_level', 'characteristic_swarming_level', 'characteristic_winter_hardiness_level', 'characteristic_wake_up_month', 'characteristic_comment' );


        $characteristics = [];
        foreach ( $inputs as $key => $input )
            if( str_contains( $key, 'characteristic_' ) )
                $characteristics[ str_replace( 'characteristic_', '', $key ) ] = $input;

        $characteristics[ 'date' ] = date( 'Y-m-d', strtotime( $characteristics[ 'date' ] ) );
        if( $characteristics['id'] == '' ){
            unset( $characteristics['id'] );
            $response_characteristic    = BeeTools::entityStore( $characteristics, 'characteristics' );
        }else
            $response_characteristic    = BeeTools::entityUpdate( $characteristics, 'characteristics' );

        $view = BeeTools::isError( $response_characteristic );
        if( $view ) return $view;

        $race[ 'id' ]               = (int) $index;
        $characteristic             = json_decode( $response_characteristic->content() );
        $race['characteristic']     = [ "id" => $characteristic->id ];
        $race_name                  = $race[ 'name' ];
        $race['name']               = [ 'name' => $race_name ];

        $race       = BeeTools::cleanElement( $race );
        $response   = BeeTools::entityUpdate( $race, 'races' );
        $view       = BeeTools::isError( $response );
        if( $view ) return $view;

        return Redirect::to( 'races' );
    }
    /**
     * Remove the specified race from storage.
     * @param  int  $index
     * @return Response
     */
    public function delete($index)
    {
        BeeTools::entityDelete( $index, 'races' );
        return Redirect::to( 'races' );
    }
}
