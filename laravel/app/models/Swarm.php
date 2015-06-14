<?php
use Vinelab\Http\Client as HttpClient;

class Swarm
{
	/**
	 * Getter Swarms
	 * @param  integer $index identifiant de l'essaim' demandée (optionnal)
	 * @return mixed Swarm object | array of Swarm objects
	 */
    public static function get($index = null)
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [
                                        'url' 		=> Config::get( 'app.api' ) . 'atomic/swarms' . ( is_null( $index ) ? '' : '/' . $index ),
                                        'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                     ] );
        return $response->json();
    }
}
