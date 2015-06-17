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
        $response   = $client->get( [
                                    'url'     => Config::get( 'app.api' ) . "atomic/queens",
                                    'headers' => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                ] );
        $view       = BeeTools::is_error( $response );
        if( $view ) return $view;                                                                                               // Retour de la vue d'erreur
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
        $client     = new HttpClient;
        $response   = $client->get( [
                                    'url'     => Config::get( 'app.api' ) . "atomic/queens/" . $index,
                                    'headers' => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                ] );
        $view       = BeeTools::is_error( $response );
        if( $view ) return $view;                                                                                               // Retour de la vue d'erreur
        $queen      = $response->json();
        return View::make( 'queens.show', [ "queen" => $queen ] );
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
        $response   = $client->get( [
                                    'url'     => Config::get( 'app.api' ) . "atomic/queens/" . $index,
                                    'headers' => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                ] );
        $view       = BeeTools::is_error( $response );
        if( $view ) return $view;                                                                                               // Retour de la vue d'erreur

        $queen = $response->json();
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
        // @TODO gestion des cas d'erreur saisie du formulaire
        $queen  = Input::except( '_token', 'race' );                                                                            // Récupération des données du formulaire sans l'association à la race
        $queen[ 'birth_date' ]  = $queen[ 'birth_date' ] != '' ? date( 'Y-m-d', strtotime( $queen[ 'birth_date' ] ) ) : null;   // Mise en forme de la date de naissance
        $queen[ 'death_date' ]  = $queen[ 'death_date' ] != '' ? date( 'Y-m-d', strtotime( $queen[ 'death_date' ] ) ) : null;   // Mise en forme de la date de décés
        $response               = BeeTools::entity_store( $queen, 'queens' );                                                   // Enregistrement de la nouvelle reine
        $view                   = BeeTools::is_error( $response );                                                              // Gestion d'une éventuelle erreur
        if( $view ) return $view;                                                                                               // Retour de la vue d'erreur

        // @TODO association à une race ---------- IN PROGRESS
        $queen          = $response->json();                                                                                    // Récupération de l'objet fraichement créé
        $race           = Input::only( 'race' );                                                                                // Récupération de la race à partir du formulaire
        $queen->race    = [ "id" => $race['race'] ];                                                                            // Ajout de la race à l'objet reine
        $queen          = BeeTools::cleanObject( $queen );                                                                      // Nettoyage de l'objet reine
        $response       = BeeTools::entity_update( $queen, 'queens' );                                                          // Mise à jour de la reine
        $view           = BeeTools::is_error( $response );                                                                      // Gestion d'une éventuelle erreur
        if( $view ) return $view;                                                                                               // Retour de la vue d'erreur

        return Redirect::to( 'queens' );                                                                                        // Retour à la vue liste des reines
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
    public function update( $index )
    {
        // @TODO gestion des cas d'erreur saisie du formulaire
        // @TODO association à une race IN PROGRESS !!!!
        $queen                  = Input::except( '_token' );                                                                    // Récupération des données du formulaire sans l'association à la race
        $queen[ 'id' ]          = (int) $index;                                                                                 // Cast de l'index
        $queen[ 'birth_date' ]  = $queen[ 'birth_date' ] != '' ? date( 'Y-m-d', strtotime( $queen[ 'birth_date' ] ) ) : null;   // Mise en forme de la date de naissance
        $queen[ 'death_date' ]  = $queen[ 'death_date' ] != '' ? date( 'Y-m-d', strtotime( $queen[ 'death_date' ] ) ) : null;   // Mise en forme de la date de décés
        $queen[ 'race' ]        = [ "id" => $queen['race'] ];                                                                   // Ajout de la race à l'objet reine
        $queen                  = BeeTools::cleanObject( $queen );                                                              // Nettoyage de l'objet reine
        $response               = BeeTools::entity_update( $queen, 'queens' );                                                  // Mise à jour de la reine
        $view                   = BeeTools::is_error( $response );                                                              // Gestion d'une éventuelle erreur
        if( $view ) return $view;                                                                                               // Retour de la vue d'erreur

        return Redirect::to( 'queens' );
    }
    /**
     * Remove the specified queen from storage.
     * @param  int  $index
     * @return Response
     */
    public function delete( $index )
    {
        $response = BeeTools::entity_delete( $index, 'queens' );
        return Redirect::to( 'queens' );
    }
}
