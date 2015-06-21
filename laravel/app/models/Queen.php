<?php
use Vinelab\Http\Client as HttpClient;

/**
 * Queen Object
 */
class Queen
{
    public $transaction   = null;
    public $unit          = null;
    public $race          = null;
    public $birth_date    = null;
    public $death_date    = null;
    public $clipping      = null;

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
        $queen_ws = BeeTools::cleanElement(Hive::get($index));

        $this->transaction  = isset($queen_ws->transaction) ? $queen_ws->transaction : null;
        $this->unit         = isset($queen_ws->unit) ? $queen_ws->unit : null;
        $this->race         = isset($queen_ws->race) ? $queen_ws->race : null;
        $this->birth_date   = isset($queen_ws->birth_date) ? $queen_ws->birth_date : null;
        $this->death_date   = isset($queen_ws->death_date) ? $queen_ws->death_date : null;
        $this->clipping     = isset($queen_ws->clipping) ? $queen_ws->clipping : null;
    }


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

    /**
     * Count queens for current exploitation
     * @return  integer number of queens
     */
    public static function getNumber()
    {
        return count(Queen::get());
    }
}
