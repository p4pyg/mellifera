<?php
use Vinelab\Http\Client as HttpClient;

/**
 * Hive Object
 */
class Hive
{

    public $trades            = null;
    public $units             = null;
    public $id_lot            = null;
    public $beehive_type      = null;
    public $number_of_frames  = null;
    public $number_of_rocks   = null;
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
        $hive_ws = BeeTools::cleanElement(Hive::get($index));

        $this->trades            = isset($hive_ws->trades) ? $hive_ws->trades : null;
        $this->units             = isset($hive_ws->units) ? $hive_ws->units : null;
        $this->id_lot            = isset($hive_ws->id_lot) ? $hive_ws->id_lot : null;
        $this->beehive_type      = isset($hive_ws->beehive_type) ? $hive_ws->beehive_type : null;
        $this->number_of_frames  = isset($hive_ws->number_of_frames) ? $hive_ws->number_of_frames : null;
        $this->number_of_rocks   = isset($hive_ws->number_of_rocks) ? $hive_ws->number_of_rocks : null;
        $this->notes             = isset($hive_ws->notes) ? $hive_ws->notes : null;
    }

    /**
     * Getter Hives
     * @param  integer $index identifiant de la ruche demandée (optionnal)
     * @return mixed Race object | array of Race objects
     */
    public static function get($index = null)
    {
        $client     = new HttpClient;
        $response   = $client->get([
                                        'url'       => Config::get('app.api') . 'atomic/beehives' . (is_null($index) ? '' : '/' . $index),
                                        'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get('api_token') ]
                                     ]);
        return $response->json();
    }

    /**
     * Get apiaries for hives
     * @param  array $hives array of hives
     * @return  array $hives array of hives with apiary
     */
    public static function getHivesApiaries($hives)
    {
        $client     = new HttpClient;
        $response   = $client->get([
                                    'url' => Config::get('app.api') . "atomic/apiaries",
                                    'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get('api_token') ]
                                    ]);
        $apiaries   = $response->json();
        foreach ($apiaries as $apiary) {
            if(! is_null($apiary->productions)){
                foreach ($apiary->productions as $production) {
                    $response   = $client->get([
                                    'url' => Config::get('app.api') . "atomic/productions/" . $production->id,
                                    'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get('api_token') ]
                                    ]);
                    $production = $response->json();
                    if(! is_null($production->unit)){
                        if(is_object($production->unit)){
                            $response   = $client->get([
                                            'url' => Config::get('app.api') . "atomic/units/" . $production->unit->id,
                                            'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get('api_token') ]
                                            ]);
                            $unit = $response->json();
                            foreach($hives as $key => $hive){
                                if($hive->id == $unit->beehive->id)
                                    $hives[ $key ]->apiary = $apiary->name;
                            }
                        }else{
                            foreach ($production->unit as $unit) {
                                $response   = $client->get([
                                                'url' => Config::get('app.api') . "atomic/units/" . $unit->id,
                                                'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get('api_token') ]
                                                ]);
                            }
                        }
                    }
                }
            }
        }
        return $hives;
    }

    /**
     * Incomplete hives
     * @return  Array Hives
     */
    public static function getIncomplete()
    {
        $hives_full = Hive::get();
        $hives      = [];
        foreach ($hives_full as $key => $hive) {
            if (!empty($hive->units)) {
                $unit = Unit::get($hive->units[0]->id);
                if (count($unit) < 3) {
                    array_push($hives, $hive);
                }
            }
        }
        return $hives;
    }


    /**
     * Gestion des niveaux d'alerte sur une ruche
     * Display Only
     */
    public static function colorizeAlert($level)
    {
        $color      = [ 'cyan darken-1', 'light-green accent-2', 'yellow lighten-1', 'orange accent-2', 'red accent-1' ];
        $icon       = [ 'mdi-action-help white-text ', 'mdi-action-done white-text ', 'mdi-action-visibility orange-text', 'mdi-alert-warning white-text ', 'mdi-alert-error white-text '];
        $messages   = trans('tools.messages');
        return '<i class="btn-floating disabled center-align ' . $icon[ $level ] . ' ' . $color[ $level ] . ' tooltipped" data-tooltip="' . $messages[ $level ] . '" data-position="bottom"></i>';
    }

    /**
     * Count hives for current exploitation
     * @return  integer number of hives
     */
    public static function getNumber()
    {
        return count(Hive::get());
    }
}
