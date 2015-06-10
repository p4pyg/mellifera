<?php
use Vinelab\Http\Client as HttpClient;

class Queen
{
    protected $queen = null;
    /**
     * Getter Queens
     * @param  integer $index identifiant de la race demandée (optionnal)
     * @return mixed Queen object | array of Queen objects
     */
    public static function get($index = null)
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [
                                        'url' => Config::get( 'app.api' ) . 'atomic/queens' . ( is_null( $index ) ? '' : '/' . $index ),
                                        'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                    ] );
        return $response->json();
    }
}