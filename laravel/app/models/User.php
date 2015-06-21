<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Vinelab\Http\Client as HttpClient;

class User extends Eloquent implements UserInterface, RemindableInterface
{
    use UserTrait, RemindableTrait;

    /**
     *  Regles de validation
     */
    public static $rules = array(
            'email'=>'required|email' ,
            'password'=>'required|alpha_num|between:4,99|confirmed',
            'password_confirmation'=>'required|alpha_num|between:4,99'
    );

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('remember_token');


    public static function get_group($index = null)
    {
        $client 	= new HttpClient;
        $request = [
                'url'		=> Config::get( 'app.api' ) . 'atomic/groups' . ( is_null( $index ) ? '' : '/' . $index ),
                'headers' 	=> ['Content-type: application/json;','APIKEY:' . \Session::get( 'api_token' ) ]
            ];
        $response 	= $client->get( $request );
        return $response->json();

    }
    public static function get_person($index = null)
    {
        $client 	= new HttpClient;
        $request = [
                'url'		=> Config::get( 'app.api' ) . 'atomic/persons' . ( is_null( $index ) ? '' : '/' . $index ),
                'headers' 	=> ['Content-type: application/json;','APIKEY:' . \Session::get( 'api_token' ) ]
            ];
        $response 	= $client->get( $request );
        return $response->json();
    }
}
