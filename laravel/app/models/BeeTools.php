<?php
use Vinelab\Http\Client as HttpClient;

class BeeTools
{
    /**
     * Helper combo
     * Transform entity name (first letter uppercase singular) to table name (full lowercase plural)
     * @param  [string] $string [name of entity]
     * @return [string]         [name of table]
     */
    public static function entity_table($string)
    {
        return mb_strtolower( str_plural( $string ) );
    }

    /**
     * Helper combo
     * Transform table name (full lowercase plural) to entity name (first letter uppercase singular)
     * @param  [string] $string [name of table]
     * @return [string]         [name of entity]
     */
    public static function table_entity($string)
    {
        return ucfirst( str_singular( $string ) );
    }

    /**
     * Helper list of month
     * @return [array]
     */
    public static function list_month($index = null)
    {
        $months = [ trans( 'tools.jan' ), trans( 'tools.feb' ), trans( 'tools.mar' ), trans( 'tools.apr' ), trans( 'tools.may' ), trans( 'tools.jun' ), trans( 'tools.jul' ), trans( 'tools.aug' ), trans( 'tools.sept' ), trans( 'tools.oct' ), trans( 'tools.nov' ), trans( 'tools.dec' ) ];
        if( is_null( $index ) )
            return $months;
        return $months[ $index ];
    }




    /**
     * Error code
     * @param  integer $code error code
     * @return  string human readable error
     */
    public static function error_code($code)
    {
        return trans( 'errors.' . $code );
    }

    /**
     * Refactoring for controllers
     * Store method
     * @param  [array]  $data   [array of data from form]
     * @param  [string] $string [object name]
     * @return [object]         [response]
     */
    public static function entity_store($data, $string)
    {
        $entity = [];
        foreach ( $data as $key => $item )
            $entity[$key] = $item === '' ? null : $item;
        $request = [
            'url' 		=> Config::get( 'app.api' ) . 'atomic/' . $string,
            'params' 	=> json_encode( $entity ),
            'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
        ];
        $client 	= new HttpClient;
        $response 	= $client->post( $request );
        return $response;
    }

    /**
     * Refactoring for controllers
     * Update method
     * @param  [array]  $data   [array of data from form]
     * @param  [string] $string [object name]
     * @return [object]         [response]
     */
    public static function entity_update($data, $string)
    {
        $entity = [];
        foreach ( $data as $key => $item )
            $entity[$key] = $item === '' ? null : $item;
        $request = [
            'url' 		=> Config::get( 'app.api' ) . 'atomic/' . $string,
            'params' 	=>  json_encode( $entity ),
            'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
        ];
        $client 	= new HttpClient;
        $response 	= $client->put( $request );
        return $response;
    }

    /**
     * Refactoring for controllers
     * Delete method
     * @param  [int]    $id     [object id]
     * @param  [string] $string [object name]
     * @return [object]         [response]
     */
    public static function entity_delete($id, $string)
    {
        $url 	= Config::get( 'app.api' ) . 'atomic/' . $string . "/" . $id;
        $json 	= '{}';
        $ch 	= curl_init();
        // Add here headers : 'Content-type: application/json' & 'APIKEY:' . \Session::get( 'api_token' )  important!
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "DELETE" );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $json );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result 	= curl_exec( $ch );
        $response 	= json_decode( $result );
        curl_close( $ch );

        return $response;
    }

    /**
     * Méthode permettant de lister des libellés nomenclaturés couplés à une liste de libellés personnalisés
     * @param string $entity nom de l'entité pour laquelle on souhaite créer l'autocomplétion
     * @param string $column nom de la propriété à autocompléter
     * @return Response JSON Array
     */
    public static function get_arraylist($entity, $column, $custom_only = null)
    {
        $client 		= new HttpClient;
        $master 		= str_singular( $entity ) . '_' . str_plural( $column );


        $response 		= $client->get( [
                                            'url' 		=> Config::get( 'app.api' ) . 'column/' . $entity . '/' . $column,
                                            'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                        ] );
        $custom_types 	= $response->json();

        if( is_null( $custom_only ) ){
            $response 	= $client->get( [
                                            'url' 		=> Config::get( 'app.api' ) . 'column/' . $master . '/name',
                                            'headers' 	=> ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                        ] );
            $top_types 	= $response->json();

            $arraylist 	= array_merge( $top_types->datas, $custom_types->datas );
        }else
            $arraylist 	= $custom_types->datas;


        foreach ( $arraylist as $key => $item )
            if( $item->value == ''|| is_null( $item->value ) )
                unset( $arraylist[ $key ] );

        return json_encode( $arraylist );
    }


    /**
     * Webservice errors
     * @param  response $response Object Response from Webservice
     * @return  View Custom view for display error | false
     */
    public static function is_error(Vinelab\Http\Response $response)
    {
        $error = [];
        $r = $response->json();
        if( empty( $r ) )
            $error['blank'] = true;

        if( $response->statusCode() != 200 ){
            $error['code'] 		= $response->statusCode();
            $error['message'] 	= "<pre>" .  $response->content() . "</pre>";
            $error['blank'] 	= false;
        }

        if( !empty( $error ) ){
            if( $error['blank'] ){ // si aucun élément n'est retourné, redirection vers le formulaire de création
                list( $entity, $page ) = explode( '.', Route::currentRouteName() );
                unset( $page );
                return Redirect::to( str_singular( $entity ) . '/edit' )->with( [ 'message' => trans( $entity . '.news') ] );
            }
            return View::make( 'errors.http_response', [ 'response' => $error ] );
        }
        return false;

    }
}
