<?php
use Vinelab\Http\Client as HttpClient;

class Hive
{
    public static function get($index = null)
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [
                                        'url' 		=> Config::get( 'app.api' ) . 'atomic/beehives' . ( is_null( $index ) ? '' : '/' . $index ),
                                        'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                     ] );
        return $response->json();
    }
}
