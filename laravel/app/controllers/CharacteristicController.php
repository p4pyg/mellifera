<?php
use Vinelab\Http\Client as HttpClient;

class CharacteristicController extends BaseController
{
    /**
     * Display characteristics list
     * @return  View characteristics.index with all characteristics
     */
    public function index()
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [
                                        'url' => Config::get( 'app.api' ) . "atomic/characteristics",
                                        'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                    ] );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $characteristics 		= $response->json();
        return View::make( 'characteristics.index', [ "characteristics" => $characteristics ] );
    }
    /**
     * Display the specified characteristic.
     *
     * @param  int  $index
     * @return Response
     */
    public function show($index)
    {
        // Todo
    }
    /**
     * Show the form for creating a new characteristic.
     * @return View characteristics.form with characteristic null
     */
    public function create()
    {
        $characteristic = null;
        return View::make( 'characteristics.form', [ 'characteristic' => $characteristic ] );
    }
    /**
     * Show the form for editing the specified characteristic.
     * @param  int  $index
     * @return View characteristics.form with characteristic
     */
    public function edit($index)
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [
                                        'url' => Config::get( 'app.api' ) . "atomic/characteristics/" . $index,
                                        'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                    ] );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $characteristic 		= $response->json();
        return View::make( 'characteristics.form', [ 'characteristic' => $characteristic ] );
    }
    /**
     * Store a newly created characteristic in storage.
     * Object structure for HTTP POST
     * $characteristic = [
     * 					"createdAt" 			=> [timestamp],
     * 					"updatedAt" 			=> [timestamp],
     * 					"date" 					=> [timestamp],
     * 					"racial_type" 			=> [string],
     * 					"aggressivness_level" 	=> [integer],
     * 					"swarming_level" 		=> [integer],
     * 					"winter_hardiness_level"=> [integer],
     * 					"wake_up_month" 		=> [string]
     * 				];
     * @return Response
     */
    public function store()
    {
        $inputs 	= Input::except( '_token' );
        $inputs[ 'date' ] 	= date( 'Y-m-d', strtotime( $inputs[ 'date' ] ) );
        // Refactored in BeeTools Model
        $response 	= BeeTools::entity_store( $inputs, 'characteristics' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'characteristics' );
    }
    /**
     * Update the specified characteristic in storage.
     * Object structure for HTTP PUT
     * $characteristic = [
     * 					"id" 					=> [integer][notnull],
     * 					"createdAt" 			=> [timestamp],
     * 					"updatedAt" 			=> [timestamp],
     * 					"date" 					=> [timestamp],
     * 					"racial_type" 			=> [string],
     * 					"aggressivness_level" 	=> [integer],
     * 					"swarming_level" 		=> [integer],
     * 					"winter_hardiness_level"=> [integer],
     * 					"wake_up_month" 		=> [string]
     * 				];
     * @param  int  $index
     * @return Response
     */
    public function update($index)
    {
        $characteristic 			= Input::except( '_token' );
        $characteristic[ 'id' ] 	= (int) $index;
        $characteristic[ 'date' ] 	= date( 'Y-m-d', strtotime( $characteristic[ 'date' ] ) );
        // Refactored in BeeTools Model
        $response 		= BeeTools::entity_update( $characteristic, 'characteristics' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'characteristics' );
    }
    /**
     * Remove the specified characteristic from storage.
     * @param  int  $index
     * @return Response
     */
    public function delete($index)
    {
        // Refactored in BeeTools Model
        $response 	= BeeTools::entity_delete( $index, 'characteristics' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'characteristics' );
    }
}
