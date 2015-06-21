<?php
use Vinelab\Http\Client as HttpClient;

class ApiaryController extends BaseController
{
    /**
     * Display apiaries list
     * @return  View apiaries.index with all apiaries
     */
    public function index()
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [
                                        'url' => Config::get( 'app.api' ) . "atomic/apiaries",
                                        'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                    ] );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }

        $apiaries 	= $response->json();
        return View::make( 'apiaries.index', [ "apiaries" => $apiaries ] );
    }
    /**
     * Display the specified apiary.
     *
     * @param  int  $index
     * @return Response
     */
    public function show($index)
    {
        // Todo
    }
    /**
     * Show the form for creating a new apiary.
     * @return View apiaries.form with apiary null
     */
    public function create()
    {
        $apiary = null;
        return View::make( 'apiaries.form', [ 'apiary' => $apiary ] );
    }
    /**
     * Show the form for editing the specified apiary.
     * @param  int  $index
     * @return View apiaries.form with apiary
     */
    public function edit($index)
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [
                                        'url' => Config::get( 'app.api' ) . "atomic/apiaries/" . $index,
                                        'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                    ] );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
        $apiary 	= $response->json();
        return View::make( 'apiaries.form', [ 'apiary' => $apiary ] );
    }
    /**
     * Store a newly created apiary in storage.
     * Object structure for HTTP POST
     * $apiary = [
     * 			"createdAt" 		=> [timestamp],
     * 			"updatedAt" 		=> [timestamp],
     * 			"weathers" 			=> [object],
     * 			"apiary_name" 		=> [string],
     * 			"address1" 			=> [string],
     * 			"address2" 			=> [string],
     * 			"postcode" 			=> [integer],
     * 			"city" 				=> [string],
     * 			"longitude" 		=> [double],
     * 			"latitude" 			=> [double],
     * 			"altitude" 			=> [integer],
     * 			"vegetation_type" 	=> [string],
     * 			"hives_capacity" 	=> [integer],
     * 			"apiary_notes" 		=> [string],
     * 			"notes" 			=> [integer]
     * 		];
     * @return Response
     */
    public function store()
    {
        $inputs 	= Input::except( '_token' );
        // Refactored in BeeTools Model
        $response 	= BeeTools::entityStore( $inputs, 'apiaries' );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'apiaries' );
    }
    /**
     * Update the specified apiary in storage.
     * Object structure for HTTP PUT
     * $apiary = [
     * 			"id" 				=> [integer][notnull],
     * 			"createdAt" 		=> [timestamp],
     * 			"updatedAt" 		=> [timestamp],
     * 			"weathers" 			=> [object],
     * 			"apiary_name" 		=> [string],
     * 			"address1" 			=> [string],
     * 			"address2" 			=> [string],
     * 			"postcode" 			=> [integer],
     * 			"city" 				=> [string],
     * 			"longitude" 		=> [double],
     * 			"latitude" 			=> [double],
     * 			"altitude" 			=> [integer],
     * 			"vegetation_type" 	=> [string],
     * 			"hives_capacity" 	=> [integer],
     * 			"notes" 			=> [string],
     * 			"rank" 				=> [integer]
     * 		];
     * @param  int  $index
     * @return Response
     */
    public function update($index)
    {
        $apiary 			= Input::except( '_token' );
        $apiary[ 'id' ] 	= (int) $index;
        // Refactored in BeeTools Model
        $response 		= BeeTools::entityUpdate( $apiary, 'apiaries' );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'apiaries' );
    }
    /**
     * Remove the specified apiary from storage.
     * @param  int  $index
     * @return Response
     */
    public function delete($index)
    {
        BeeTools::entityDelete( $index, 'apiaries' );
        return Redirect::to( 'apiaries' );
    }
}
