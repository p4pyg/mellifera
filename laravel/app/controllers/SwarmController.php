<?php
use Vinelab\Http\Client as HttpClient;

class SwarmController extends \BaseController
{
    /**
     * Display a listing of the swarms.
     * @return View swarms.index with all swarms
     */
    public function index()
    {
        $client     = new HttpClient;
        $response   = $client->get([ 'url' => Config::get('app.api')  . "atomic/swarms", 'headers'  => ['Content-type: application/json','APIKEY:' . \Session::get('api_token')  ] ]) ;
        $view       = BeeTools::isError($response) ;
        if ($view) {
            return $view;
        }
        $swarms     = $response->json();
        $hives      = Hive::getIncomplete();
        return View::make('swarms.index', [ "swarms" => $swarms, "hives" => $hives ]) ;
    }

    /**
     * Display the specified swarm.
     *
     * @param  int  $index
     * @return Response
     */
    public function show($index)
    {
        // Todo
    }
    /**
     * Show the form for creating a new swarm.
     * @return View swarms.form with swarm null
     */
    public function create()
    {
        $swarm = null;
        $races = Race::get();
        $units = Unit::get();
        return View::make('swarms.form', [ 'swarm' => $swarm, 'races' => $races , 'units' => $units ]) ;
    }
    /**
     * Show the form for editing the specified swarm.
     * @param  int  $index
     * @return View swarms.form with swarm
     */
    public function edit($index)
    {
        $client     = new HttpClient;
        $response   = $client->get([ 'url' => Config::get('app.api') . "atomic/swarms/" . $index, 'headers'    => ['Content-type: application/json','APIKEY:' . \Session::get('api_token') ] ]) ;
        $view       = BeeTools::isError($response) ;
        if ($view) {
            return $view;
        }
        $swarm      = $response->json();
        $units      = [];
        return View::make('swarms.form', [ 'swarm' => $swarm, 'units' => $units ]) ;
    }
    /**
     * Store a newly created swarm in storage.
     * Object structure for HTTP POST
     * $swarm = [
     *          "createdAt"             => [timestamp],
     *          "updatedAt"             => [timestamp],
     *          "is_in"                 => [object],
     *          "trades"                => [object],
     *          "creation_date"         => [timestamp],
     *          "extermination_date"    => [timestamp],
     *          "purpose"               => [string],
     *          "notes"                 => [string]
     *      ];
     * @return Response
     */
    public function store()
    {
        $inputs = Input::except('_token', 'multiple');
        $input  = Input::only('multiple');
        $multi  = $input['multiple'];
        while ($multi > 0) {
            $response   = BeeTools::entityStore($inputs, 'swarms');
            $view       = BeeTools::isError($response);
            if ($view) {
                return $view;
            }
            $multi--;
        }
        return Redirect::to('swarms');
    }
    /**
     * Update the specified swarm in storage.
     * Object structure for HTTP PUT
     * $swarm = [
     *          "id"                    => [integer][notnull],
     *          "createdAt"             => [timestamp],
     *          "updatedAt"             => [timestamp],
     *          "is_in"                 => [object],
     *          "trades"                => [object],
     *          "creation_date"         => [timestamp],
     *          "extermination_date"    => [timestamp],
     *          "purpose"               => [string],
     *          "notes"                 => [string]
     *      ];
     * @param  int  $index
     * @return Response
     */
    public function update($index)
    {
        $swarm          = Input::except('_token') ;
        $swarm[ 'id' ]  = (int) $index;
        $response       = BeeTools::entityUpdate($swarm, 'swarms') ;
        $view           = BeeTools::isError($response) ;
        if ($view) {
            return $view;
        }
        return Redirect::to('swarms') ;
    }
    /**
     * Remove the specified swarm from storage.
     * @param  int  $index
     * @return Response
     */
    public function delete($index)
    {
        BeeTools::entityDelete($index, 'swarms') ;
        return Redirect::to('swarms') ;
    }

    /**
     * Déplacer ou affecter un essaim à une ruche
     * @return  Redirect
     */
    public function transfert()
    {
        $inputs = Input::only('swarm','hive');

        extract($inputs);

        $request = [
                    'url'       => Config::get('app.api') . 'atomic/association',
                    'params'    => json_encode(['swarm' => $swarm, 'beehive' => $hive]),
                    'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get('api_token') ]
                ];

        $client     = new HttpClient;
        $client->post($request);

        return Redirect::back();
    }

}
