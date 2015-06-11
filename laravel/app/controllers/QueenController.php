<?php
use Vinelab\Http\Client as HttpClient;

class QueenController extends \BaseController
{
    /**
     * Display a listing of the queens.
     * @return View queens.index with all queens
     */
    public function index()
    {
        $client     = new HttpClient;
        $response   = $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/queens", 'headers'    => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view       = BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $queens     = $response->json();
        return View::make( 'queens.index', [ "queens" => $queens ] );
    }

    /**
     * Display the specified queen.
     *
     * @param  int  $index
     * @return Response
     */
    public function show($index)
    {
        // Todo
    }
    /**
     * Show the form for creating a new queen.
     * @return View queens.form with queen null
     */
    public function create()
    {
        $queen = null;
        $races = Race::get();

        return View::make( 'queens.form', [ 'queen' => $queen, 'races' => $races ] );
    }
    /**
     * Show the form for editing the specified queen.
     * @param  int  $index
     * @return View queens.form with queen
     */
    public function edit($index)
    {
        $client     = new HttpClient;
        $response   = $client->get( [ 'url' => Config::get( 'app.api' ) . "atomic/queens/" . $index, 'headers'  => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ] ] );
        $view       = BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        $queen      = $response->json();
        $races = Race::get();
        return View::make( 'queens.form', [ 'queen' => $queen, 'races' => $races ] );
    }
    /**
     * Store a newly created queen in storage.
     * Object structure for HTTP POST
     * $queen = [
     *          "transaction"   => [object],
     *          "unit"          => [object],
     *          "race"          => [object],
     *          "birth_date"    => [timestamp],
     *          "death_date"    => [timestamp],
     *          "clipping"      => [boolean]
     *      ];
     * @return Response
     */
    public function store()
    {
        // @TODO association à une race
        $inputs             = Input::except( '_token', 'race' );

        $queen[ 'birth_date' ] = $queen[ 'birth_date' ] != '' ? date( 'Y-m-d', strtotime( $queen[ 'birth_date' ] ) ) : '';
        $queen[ 'death_date' ] = $queen[ 'death_date' ] != '' ? date( 'Y-m-d', strtotime( $queen[ 'death_date' ] ) ) : '';
        // Refactored in BeeTools Model
        $response           = BeeTools::entity_store( $inputs, 'queens' );
        $view               = BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }

        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'queens' );
    }
    /**
     * Update the specified queen in storage.
     * Object structure for HTTP PUT
     * $queen = [
     *          "id"            => [integer][notnull],
     *          "transaction"   => [object],
     *          "unit"          => [object],
     *          "race"          => [object],
     *          "birth_date"    => [timestamp],
     *          "death_date"    => [timestamp],
     *          "clipping"      => [boolean]
     *      ];
     * @param  int  $index
     * @return Response
     */
    public function update($index)
    {
         // @TODO association à une race IN PROGRESS !!!!
        $queen          = Input::except( '_token' );
        $queen[ 'id' ]  = (int) $index;
        $queen[ 'birth_date' ] = $queen[ 'birth_date' ] != '' ? date( 'Y-m-d', strtotime( $queen[ 'birth_date' ] ) ) : '';
        $queen[ 'death_date' ] = $queen[ 'death_date' ] != '' ? date( 'Y-m-d', strtotime( $queen[ 'death_date' ] ) ) : '';

        $queen['race'] = Race::get( $queen['race'] );
        $queen['race'] = BeeTools::cleanObject( $queen['race'] );
        // echo '<pre>';
        // print_r( $queen );
        // echo '</pre>';
        // die('<p style="color:orange; font-weight:bold;">Raison</p>');
        // Refactored in BeeTools Model
        $response   = BeeTools::entity_update( $queen, 'queens' );
        $view       = BeeTools::is_error( $response );
        if( $view ){
            return $view;
        }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'queens' );
    }
    /**
     * Remove the specified queen from storage.
     * @param  int  $index
     * @return Response
     */
    public function delete($index)
    {
        // Refactored in BeeTools Model
        $response   = BeeTools::entity_delete( $index, 'queens' );

        echo '<pre>';
        print_r($response);
        echo '</pre>';
        die('<p style="color:orange; font-weight:bold;">Raison</p>');
        // $view       = BeeTools::is_error( $response );
        // if( $view ){
        //     return $view;
        // }
        // WORK IN PROGRESS
        // return response
        return Redirect::to( 'queens' );
    }

}
