<?php
use Vinelab\Http\Client as HttpClient;
/**
 * Class outil propre à l'application
 * Cette classe est composée de méthodes statiques généralisant des fonctionnalités utilisées dans l'ensemble des controlleurs, modèles et vues
 */
class BeeTools
{
    /**
     * Helper combo
     * Transform entity name (first letter uppercase singular) to table name (full lowercase plural)
     * @param  [string] $string [name of entity]
     * @return [string]         [name of table]
     */
    public static function entityTable($string)
    {
        return mb_strtolower(str_plural($string));
    }

    /**
     * Helper combo
     * Transform table name (full lowercase plural) to entity name (first letter uppercase singular)
     * @param  [string] $string [name of table]
     * @return [string]         [name of entity]
     */
    public static function tableEntity($string)
    {
        return ucfirst(str_singular($string));
    }

    /**
     * Helper list of month
     * @return [array]
     */
    public static function listMonth($index = null)
    {
        $months = [ trans('tools.jan'), trans('tools.feb'), trans('tools.mar'), trans('tools.apr'), trans('tools.may'), trans('tools.jun'), trans('tools.jul'), trans('tools.aug'), trans('tools.sept'), trans('tools.oct'), trans('tools.nov'), trans('tools.dec') ];
        if(is_null($index))
            return $months;
        return $months[ $index ];
    }

    /**
     * Calcul d'un âge
     * @param string $birth_date date de naissance Y-m-d
     * @return string âge en années | mois
     */
    public static function elapsedTime($birth_date)
    {
        $birth      = new DateTime($birth_date);
        $interval   = date_create('now')->diff($birth);
        if($year = $interval->y > 0)
            return $interval->y . '&nbsp;' . ($year > 1 ? str_plural(trans('tools.year')) : trans('tools.year')) . '&nbsp;' . $interval->m . '&nbsp;' . trans('tools.month');
        return $interval->m . 'mois';
    }

    /**
     * Error code
     * @param  integer $code error code
     * @return  string human readable error
     */
    public static function errorCode($code)
    {
        return trans('errors.' . $code);
    }

    /**
     * Refactoring for controllers
     * Store method
     * @param  [array]  $data   [array of data from form]
     * @param  [string] $string [object name]
     * @return [object]         [response]
     */
    public static function entityStore($data, $string)
    {
        $entity = [];
        foreach ($data as $key => $item)
            $entity[$key] = $item === '' ? null : $item;
        $request = [
            'url'       => Config::get('app.api') . 'atomic/' . $string,
            'params'    => json_encode($entity),
            'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get('api_token') ]
        ];
        $client     = new HttpClient;
        $response   = $client->post($request);
        return $response;
    }

    /**
     * Refactoring for controllers
     * Update method
     * @param  [array]  $data   [array of data from form]
     * @param  [string] $string [object name]
     * @return [object]         [response]
     */
    public static function entityUpdate($data, $string)
    {
        $entity = [];
        foreach ($data as $key => $item)
            $entity[$key] = $item === '' ? null : $item;
        $request = [
            'url'       => Config::get('app.api') . 'atomic/' . $string,
            'params'    => json_encode($entity),
            'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get('api_token') ]
        ];

        $client     = new HttpClient;
        $response   = $client->put($request);
        return $response;
    }

    /**
     * Refactoring for controllers
     * Delete method
     * @param  [int]    $index  [object id]
     * @param  [string] $string [object name]
     * @return [object]         [response]
     */
    public static function entityDelete($index, $string)
    {
        $url    = Config::get('app.api') . 'atomic/' . $string . "/" . $index;
        $json   = '{}';
        $ch     = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [ 'APIKEY:' . \Session::get('api_token') ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result     = curl_exec($ch);
        $response   = json_decode($result);
        curl_close($ch);
        return $response;
    }

    /**
     * Méthode permettant de lister des libellés nomenclaturés couplés à une liste de libellés personnalisés
     * @param string $entity nom de l'entité pour laquelle on souhaite créer l'autocomplétion
     * @param string $column nom de la propriété à autocompléter
     * @param boolean $custom_only mettre à vrai pour retourner uniquement les types propres à l'exploitation
     * @param boolean $retrieve_id mettre à vrai pour retourner un tableau indexé avec les identifiants des types et leur valeur respective
     * @return mixed Response JSON Array / PHP array indexed by id from $entity
     */
    public static function getArraylist($entity, $column, $custom_only = false, $retrieve_id = false)
    {
        $client         = new HttpClient;
        $master         = str_singular($entity) . '_' . str_plural($column);


        $response       = $client->get([
                                            'url'       => Config::get('app.api') . 'column/' . $entity . '/' . $column,
                                            'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get('api_token') ]
                                        ]);
        $custom_types   = $response->json();

        if(! $custom_only){
            $response   = $client->get([
                                            'url'       => Config::get('app.api') . 'column/' . $master . '/name',
                                            'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get('api_token') ]
                                        ]);
            $top_types  = $response->json();
            if (isset($custom_types->datas)){
                $arraylist  = array_merge($top_types->datas, $custom_types->datas);
            } else {
                $arraylist  = $top_types->datas;
            }
        }else
            $arraylist  = $custom_types->datas;

        $array_by_id = [];
        foreach ($arraylist as $key => $item)
            if($item->value !== '' && is_string($item->value))
                $array_by_id[ $item->id ] = $item->value;

        if($retrieve_id){
            return $array_by_id;
        }else{
            $simple_json_array = [];
            foreach ($array_by_id as $value) {
                array_push($simple_json_array, $value);
            }
            return json_encode($simple_json_array);
        }
    }

    /**
     * Get list of apiaries
     * @return JSON array list of apiaies for current exploitatation
     */
    public static function getApiaries()
    {
        $request = [
            'url'       => Config::get('app.api') . 'atomic/apiaries',
            'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get('api_token') ]
        ];
        $client     = new HttpClient;
        $response   = $client->get($request);
        return $response->content();
    }

    /**
     * Méthode récursive de nettoyage d'objets ou de tableaux
     * @param objet|array $element
     * @return  objet|array nettoyé
     */
    public static function cleanElement($element)
    {
        $keys = [ 'created_at', 'updated_at', 'deleted_at', 'label' ];
        foreach ($element as $key => $item) {
            if(is_object($item))
                BeeTools::cleanElement($item);
            if(in_array($key, $keys) || is_null($item) || $item == '' || (is_array($item) && empty($item)))
                unset($element->$key);
        }
        return $element;
    }


    /**
     * Webservice errors
     * @param  response $response Object Response from Webservice
     * @return  View Custom view for display error | false
     */
    public static function isError(Vinelab\Http\Response $response)
    {
        $error = [];
        $ws_response = $response->json();
        if(empty($ws_response))
            $error['blank'] = true;

        if($response->statusCode() != 200){
            $error['code']      = $response->statusCode();
            $error['message']   = $response->content();
            $error['blank']     = false;
        }

        if(!empty($error)){
            if($error['blank']){ // si aucun élément n'est retourné, redirection vers le formulaire de création
                list($entity, $page) = explode('.', Route::currentRouteName());
                unset($page);
                return Redirect::to(str_singular($entity) . '/edit')->with([ 'message' => trans($entity . '.news') ]);
            }
            return View::make('errors.http_response', [ 'response' => $error ]);
        }
        return false;

    }




}
