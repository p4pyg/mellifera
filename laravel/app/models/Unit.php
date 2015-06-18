<?php
use Vinelab\Http\Client as HttpClient;

/**
 * Unit Object
 */
class Unit
{

    public $id                    = null;
    public $queen                 = null;
    public $swarm                 = null;
    public $beehive               = null;
    public $characteristics       = null;
    public $daugthers             = null;
    public $sons                  = null;
    public $files                 = null;
    public $productions           = null;
    public $association_date      = null;
    public $separation_date       = null;

    public function __construct()
    {
        $args   = func_get_args();
        $number = func_num_args();
        if (method_exists($this,$func = '__construct' . $number)) {
            call_user_func_array([$this, $func], $args);
        }
    }

    public function __construct1($index = null)
    {
        $unit_ws                    = BeeTools::cleanObject(Unit::get($index));
        $this->id                   = isset($unit_ws->id) ? $unit_ws->id : null;
        $this->queen                = isset($unit_ws->queen) ? $unit_ws->queen : null;
        $this->swarm                = isset($unit_ws->swarm) ? $unit_ws->swarm : null;
        $this->beehive              = isset($unit_ws->beehive) ? $unit_ws->beehive : null;
        $this->characteristics      = isset($unit_ws->characteristics) ? $unit_ws->characteristics : null;
        $this->daugthers            = isset($unit_ws->daugthers) ? $unit_ws->daugthers : null;
        $this->sons                 = isset($unit_ws->sons) ? $unit_ws->sons : null;
        $this->files                = isset($unit_ws->files) ? $unit_ws->files : null;
        $this->productions          = isset($unit_ws->productions) ? $unit_ws->productions : null;
        $this->association_date     = isset($unit_ws->association_date) ? $unit_ws->association_date : null;
        $this->separation_date      = isset($unit_ws->separation_date) ? $unit_ws->separation_date : null;
    }


    /**
     * Getter Units
     * @param  integer $index identifiant de l'unité demandée (optionnal)
     * @return mixed Unit object | array of Unit objects
     */
    public static function get($index = null)
    {
        $client     = new HttpClient;
        $response   = $client->get( [
                                        'url'       => Config::get( 'app.api' ) . 'atomic/units' . ( is_null( $index ) ? '' : '/' . $index ),
                                        'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                     ] );
        return $response->json();
    }

    /**
     * Méthode de tris
     * @param  array Object $entity tableau d'objets
     * @param  boolean $not permet d'inverser le résultat (defaut true : objets affectés)
     * @return  array Object tableau d'objet qui sont/ne sont pas affectés à une unité de production
     */
    public static function have( $entities , $not = true )
    {
        $orbit = [];

        foreach ( $entities as $key => $entity ) {
            if( $not && empty( $entity->is_in )  )
                array_push( $orbit, $entity );
            if( !$not && ! empty( $entity->is_in ) )
                array_push( $orbit, $entity );
        }
        return $orbit;
    }

}
