<?php
use Vinelab\Http\Client as HttpClient;

/**
 * Controller Person
 * - Préparation des vues des différents formulaires du CRUD
 * - Gestion du CRUD via le webservice
 * @see  Vinelab package de gestion des actions RestFull
 */
class PersonController extends \BaseController
{
    /**
     * Display a listing of the persons.
     * @return View persons.index with all persons
     */
    public function index()
    {
        $client     = new HttpClient;
        $response   = $client->get([
                                    'url'       => Config::get( 'app.api' ) . "atomic/persons",
                                    'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                ] );
        $view       = BeeTools::is_error( $response );
        if ( $view ){
            return $view;
        }
        $persons    = $response->json();
        return View::make( 'persons.index', [ "persons" => $persons ] );
    }

    /**
     * Display the specified person.
     *
     * @param  int  $index
     * @return Response
     */
    public function show($index)
    {
        // Todo
    }
    /**
     * Show the form for creating a new person.
     * @return View persons.form with person null
     */
    public function create()
    {
        $person = null;
        return View::make('persons.form', ['person' => $person]);
    }
    /**
     * Show the form for editing the specified person.
     * @param  int  $index
     * @return View persons.form with person
     */
    public function edit($index)
    {
        $person = new Person($index);

        return View::make( 'persons.form', [ 'person' => $person ] );
    }
    /**
     * Store a newly created person in storage.
     * Object structure for HTTP POST
     * $person = [
     *          "createdAt"             => [timestamp],
     *          "updatedAt"             => [timestamp],
     *          "last_name"             => [string],
     *          "first_name"            => [string],
     *          "address1"              => [string],
     *          "address2"              => [string],
     *          "postcode"              => [integer],
     *          "city"                  => [string],
     *          "phone"                 => [long],
     *          "email"                 => [string],
     *          "notes"                 => [string],
     *          "user"                  => [object],
     *          "trades_with_sellers"   => [object],
     *          "trades_with_buyers"    => [object]
     *      ];
     * @return Response
     */
    public function store()
    {
        $person     = Input::except('_token', 'email', 'password', 'password_confirmation');
        $user       = Input::only('email', 'password');
        $password   = Input::only('password_confirmation');

        if ($user['password'] === $password['password_confirmation']) {
            $response   = BeeTools::entity_update($user, 'users');
            $view       = BeeTools::is_error($response);
            if ($view) {
                return $view;
            }
        }
        $response       = BeeTools::entity_store($person, 'persons');
        $view           = BeeTools::is_error($response);
        if ($view) {
            return $view;
        }

        return Redirect::back();
    }

    /**
     * Update the specified person in storage.
     * Object structure for HTTP PUT
     * $person = [
     *          "id"                    => [integer][notnull],
     *          "createdAt"             => [timestamp],
     *          "updatedAt"             => [timestamp],
     *          "last_name"             => [string],
     *          "first_name"            => [string],
     *          "address1"              => [string],
     *          "address2"              => [string],
     *          "postcode"              => [integer],
     *          "city"                  => [string],
     *          "phone"                 => [long],
     *          "email"                 => [string],
     *          "notes"                 => [string],
     *          "user"                  => [object],
     *          "trades_with_sellers"   => [object],
     *          "trades_with_buyers"    => [object]
     *      ];
     * @param  int  $index
     * @return Response
     */
    public function update($index)
    {
        $person         = Input::except('_token', 'email', 'password', 'password_confirmation');
        $person[ 'id' ] = (int) $index;

        $user       = Input::only('email', 'password');
        $password   = Input::only('password_confirmation');

        if ($user['password'] === $password['password_confirmation']) {
            $response   = BeeTools::entity_update($user, 'users');
            $view       = BeeTools::is_error($response);
            if ($view) {
                return $view;
            }
        }
        $person['user'] = ['id' => Auth::user()->id ];
        $response   = BeeTools::entity_update($person, 'persons');
        $view       = BeeTools::is_error($response);
        if ($view) {
            return $view;
        }
        return Redirect::back();
    }
    /**
     * Remove the specified person from storage.
     * @param  int  $index
     * @return Response
     */
    public function delete($index)
    {
        BeeTools::entity_delete($index, 'persons');
        return Redirect::to('persons');
    }

}
