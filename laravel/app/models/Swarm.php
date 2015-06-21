<?php
use Vinelab\Http\Client as HttpClient;

/**
 * Swarm Object
 */
class Swarm
{

    public $is_in                 = null;
    public $trades                = null;
    public $creation_date         = null;
    public $extermination_date    = null;
    public $purpose               = null;
    public $notes                 = null;

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
        $swarm_ws                   = BeeTools::cleanElement(Swarm::get($index));
        $this->id                   = isset($swarm_ws->id) ? $swarm_ws->id:null;
        $this->is_in                = isset($swarm_ws->is_in) ? $swarm_ws->is_in : null;
        $this->trades               = isset($swarm_ws->trades) ? $swarm_ws->trades : null;
        $this->creation_date        = isset($swarm_ws->creation_date) ? $swarm_ws->creation_date : null;
        $this->extermination_date   = isset($swarm_ws->extermination_date) ? $swarm_ws->extermination_date : null;
        $this->purpose              = isset($swarm_ws->purpose) ? $swarm_ws->purpose : null;
        $this->notes                = isset($swarm_ws->notes) ? $swarm_ws->notes : null;
    }

    /**
     * Getter Swarms
     * @param  integer $index identifiant de l'essaim' demandée (optionnal)
     * @return mixed Swarm object | array of Swarm objects
     */
    public static function get($index = null)
    {
        $client     = new HttpClient;
        $response   = $client->get( [
                                        'url'       => Config::get( 'app.api' ) . 'atomic/swarms' . ( is_null( $index ) ? '' : '/' . $index ),
                                        'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                     ] );
        return $response->json();
    }
    /**
     * Count swarms for current exploitation
     * @return  integer number of swarms
     */
    public static function getNumber()
    {
        return count(Swarm::get());
    }
}
