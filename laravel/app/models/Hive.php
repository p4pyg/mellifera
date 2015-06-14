<?php
use Vinelab\Http\Client as HttpClient;

class Hive
{
	/**
	 * Getter Hives
	 * @param  integer $index identifiant de la ruche demandée (optionnal)
	 * @return mixed Race object | array of Race objects
	 */
    public static function get($index = null)
    {
        $client 	= new HttpClient;
        $response 	= $client->get( [
                                        'url' 		=> Config::get( 'app.api' ) . 'atomic/beehives' . ( is_null( $index ) ? '' : '/' . $index ),
                                        'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                     ] );
        return $response->json();
    }

    /**
     * Get apiaries for hives
     * @param  array $hives array of hives
     * @return  array $hives array of hives with apiary
     */
    public static function getHivesApiarie( $hives )
    {
        $client     = new HttpClient;
        $response   = $client->get( [
                                    'url' => Config::get( 'app.api' ) . "atomic/apiaries",
                                    'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                    ] );
        $apiaries   = $response->json();
        foreach ( $apiaries as $apiary ) {
            if( ! is_null( $apiary->productions ) ){
                foreach ( $apiary->productions as $production) {
                    $response   = $client->get( [
                                    'url' => Config::get( 'app.api' ) . "atomic/productions/" . $production->id,
                                    'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                    ] );
                    $production = $response->json();
                    if( ! is_null( $production->unit ) ){
                        if( is_object( $production->unit ) ){
                            $response   = $client->get( [
                                            'url' => Config::get( 'app.api' ) . "atomic/units/" . $production->unit->id,
                                            'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                            ] );
                            $unit = $response->json();
                            foreach( $hives as $key => $hive ){
                                if( $hive->id == $unit->beehive->id )
                                    $hives[ $key ]->apiary = $apiary->name;
                            }
                        }else{
                            foreach ( $production->unit as $unit ) {
                                $response   = $client->get( [
                                                'url' => Config::get( 'app.api' ) . "atomic/units/" . $unit->id,
                                                'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                                ] );
                            }
                        }
                    }
                }
            }
        }
        return $hives;
    }

    /**
     * Gestion des niveaux d'alerte sur une ruche
     * Display Only
     */
    public static function colorizeAlert( $level )
    {
        $color      = [ 'cyan darken-1', 'light-green accent-2', 'yellow lighten-1', 'orange accent-2', 'red accent-1' ];
        $icon       = [ 'mdi-action-help white-text ', 'mdi-action-done white-text ', 'mdi-action-visibility orange-text', 'mdi-alert-warning white-text ', 'mdi-alert-error white-text '];
        $messages   = trans( 'tools.messages' );
        return '<i class="btn-floating  center-align ' . $icon[ $level ] . ' ' . $color[ $level ] . ' tooltipped" data-tooltip="' . $messages[ $level ] . '" data-position="bottom"></i>';
    }
}
