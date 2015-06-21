<?php
use Vinelab\Http\Client as HttpClient;

class StrengtheController extends \BaseController
{
    /**
     * Display a listing of the strengthes.
     * @return View strengthes.index with all strengthes
     */
    public function index()
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/strengthes", 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $strengthes 	= $response->json();
        return View::make( 'strengthes.index', [ "strengthes" => $strengthes ] );
    }

    /**
     * Display the specified strengthe.
     *
     * @param  int  $index
     * @return Response
     */
    public function show($index)
    {
        // Todo
    }
    /**
     * Show the form for creating a new strengthe.
     * @return View strengthes.form with strengthe null
     */
    public function create()
    {
        $strengthe = null;
        return View::make( 'strengthes.form', [ 'strengthe' => $strengthe ] );
    }
    /**
     * Show the form for editing the specified strengthe.
     * @param  int  $index
     * @return View strengthes.form with strengthe
     */
    public function edit($index)
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/strengthes/" . $index, 'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $strengthe 		= $response->json();
        return View::make( 'strengthes.form', [ 'strengthe' => $strengthe ] );
    }
    /**
     * Store a newly created strengthe in storage.
     * Object structure for HTTP POST
     * $strengthe = [
     * 			"createdAt" 			=> [timestamp],
     * 			"updatedAt" 			=> [timestamp],
     * 			"production" 			=> [object],
     * 			"checking_date" 		=> [timestamp],
     * 			"number_of_brood_frames"=> [integer]
     * 		];
     * @return Response
     */
    public function store()
    {
        $inputs 	= Input::except( '_token' );
        // Refactored in BeeTools Model
        $response 	= BeeTools::entity_store( $inputs, 'strengthes' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'strengthes' );
    }
    /**
     * Update the specified strengthe in storage.
     * Object structure for HTTP PUT
     * $strengthe = [
     * 			"id" 					=> [integer][notnull],
     * 			"createdAt" 			=> [timestamp],
     * 			"updatedAt" 			=> [timestamp],
     * 			"production" 			=> [object],
     * 			"checking_date" 		=> [timestamp],
     * 			"number_of_brood_frames"=> [integer]
     * 		];
     * @param  int  $index
     * @return Response
     */
    public function update($index)
    {
        $strengthe 			= Input::except( '_token' );
        $strengthe[ 'id' ]	= (int) $index;
        // Refactored in BeeTools Model
        $response 		= BeeTools::entity_update( $strengthe, 'strengthes' );
        $view 		= BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'strengthes' );
    }
    /**
     * Remove the specified strengthe from storage.
     * @param  int  $index
     * @return Response
     */
    public function delete($index)
    {
        BeeTools::entity_delete( $index, 'strengthes' );
        return Redirect::to( 'strengthes' );
    }

}
