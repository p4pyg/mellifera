<?php
use Vinelab\Http\Client as HttpClient;

class Race
{
    protected $race = null;
    /**
     * Getter for Races
     * @param  integer $index identifiant de la race demandée (optionnal)
     * @return mixed Race object | array of Race objects
     */
    public static function get($index = null)
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [
                                        'url' => Config::get( 'app.api' ) . 'atomic/races' . ( is_null( $index ) ? '' : '/' . $index ),
                                        'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                    ] );
        return $response->json();
    }
}
