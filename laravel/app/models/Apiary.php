<?php
use Vinelab\Http\Client as HttpClient;

/**
 * Apiary Object
 */
class Apiary
{
    public $id                = null;
    public $apiary_name       = null;
    public $address1          = null;
    public $address2          = null;
    public $postcode          = null;
    public $city              = null;
    public $longitude         = null;
    public $latitude          = null;
    public $altitude          = null;
    public $vegetation_type   = null;
    public $hives_capacity    = null;
    public $apiary_notes      = null;
    public $weathers          = null;
    public $notes             = null;

    public function __construct()
    {
        $args   = func_get_args();
        $number = func_num_args();
        if (method_exists($this,$func = '__construct' . $number)) {
            call_user_func_array([$this, $func], $args);
        }
    }

    public function __construct1($index)
    {
        $apiary_ws = BeeTools::cleanElement(Apiary::get($index));
        $this->id               = isset($apiary_ws->id) ? $apiary_ws->id:null;
        $this->weathers         = isset($apiary_ws->weathers) ? $apiary_ws->weathers:null;
        $this->apiary_name      = isset($apiary_ws->apiary_name) ? $apiary_ws->apiary_name:null;
        $this->address1         = isset($apiary_ws->address1) ? $apiary_ws->address1:null;
        $this->address2         = isset($apiary_ws->address2) ? $apiary_ws->address2:null;
        $this->postcode         = isset($apiary_ws->postcode) ? $apiary_ws->postcode:null;
        $this->city             = isset($apiary_ws->city) ? $apiary_ws->city:null;
        $this->longitude        = isset($apiary_ws->longitude) ? $apiary_ws->longitude:null;
        $this->latitude         = isset($apiary_ws->latitude) ? $apiary_ws->latitude:null;
        $this->altitude         = isset($apiary_ws->altitude) ? $apiary_ws->altitude:null;
        $this->vegetation_type  = isset($apiary_ws->vegetation_type) ? $apiary_ws->vegetation_type:null;
        $this->hives_capacity   = isset($apiary_ws->hives_capacity) ? $apiary_ws->hives_capacity:null;
        $this->apiary_notes     = isset($apiary_ws->apiary_notes) ? $apiary_ws->apiary_notes:null;
        $this->notes            = isset($apiary_ws->notes) ? $apiary_ws->notes:null;
    }

    /**
     * Getter for Apiaries
     * @param  integer $index identifiant du rucher demandée (optionnal)
     * @return mixed Apiary object | array of Apiary objects
     */
    public static function get($index = null)
    {
        $client     = new HttpClient;
        $response   = $client->get( [
                                        'url' => Config::get( 'app.api' ) . 'atomic/apiaries' . ( is_null( $index ) ? '' : '/' . $index ),
                                        'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                    ] );
        return $response->json();
    }

    /**
     * Count apiaries for current exploitation
     * @return  integer number of apiaries
     */
    public static function getNumber()
    {
        return count(Apiary::get());
    }
}
