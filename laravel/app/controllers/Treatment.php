<?php
use Vinelab\Http\Client as HttpClient;

class TreatmentController extends \BaseController
{
    /**
     * Display a listing of the treatments.
     * @return View treatments.index with all treatments
     */
    public function index()
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/treatments", 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
        $treatments 	= $response->json();
        return View::make( 'treatments.index', [ "treatments" => $treatments ] );
    }

    /**
     * Display the specified treatment.
     *
     * @param  int  $index
     * @return Response
     */
    public function show($index)
    {
        // Todo
    }
    /**
     * Show the form for creating a new treatment.
     * @return View treatments.form with treatment null
     */
    public function create()
    {
        $treatment = null;
        return View::make( 'treatments.form', [ 'treatment' => $treatment ] );
    }
    /**
     * Show the form for editing the specified treatment.
     * @param  int  $index
     * @return View treatments.form with treatment
     */
    public function edit($index)
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/treatments/" . $index, 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
        $treatment 		= $response->json();
        return View::make( 'treatments.form', [ 'treatment' => $treatment ] );
    }
    /**
     * Store a newly created treatment in storage.
     * Object structure for HTTP POST
     * $treatment = [
     * 			"createdAt" 			=> [timestamp],
     * 			"updatedAt" 			=> [timestamp],
     * 			"treatment_date" 		=> [timestamp],
     * 			"desease_treated" 		=> [string]
     * 			"product_quantity" 		=> [float],
     * 		];
     * @return Response
     */
    public function store()
    {
        $inputs 	= Input::except( '_token' );
        // Refactored in BeeTools Model
        $response 	= BeeTools::entityStore( $inputs, 'treatments' );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'treatments' );
    }
    /**
     * Update the specified treatment in storage.
     * Object structure for HTTP PUT
     * $treatment = [
     * 			"id" 					=> [integer][notnull],
     * 			"createdAt" 			=> [timestamp],
     * 			"updatedAt" 			=> [timestamp],
     * 			"treatment_date" 		=> [timestamp],
     * 			"desease_treated" 		=> [string]
     * 			"product_quantity" 		=> [float],
     * 		];
     * @param  int  $index
     * @return Response
     */
    public function update($index)
    {
        $treatment 			= Input::except( '_token' );
        $treatment[ 'id' ]	= (int) $index;
        $response 		= BeeTools::entityUpdate( $treatment, 'treatments' );
        $view 		= BeeTools::isError( $response );
        if( $view ){
            return $view;
        }
        return Redirect::to( 'treatments' );
    }
    /**
     * Remove the specified treatment from storage.
     * @param  int  $index
     * @return Response
     */
    public function delete($index)
    {
        BeeTools::entityDelete( $index, 'treatments' );
        return Redirect::to( 'treatments' );
    }

}
