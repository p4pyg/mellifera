<?php
use Vinelab\Http\Client as HttpClient;

class Unit
{
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
