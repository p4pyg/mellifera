<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Vinelab\Http\Client as HttpClient;

class User extends Eloquent implements UserInterface, RemindableInterface {

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
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
	protected $hidden = array('remember_token');


	/**
	 * Create or authenticate use
	 */
/*
	static public function authenticate( $email, $password )
	{
		$user = [
			"email" 		=> $email,
			"password" 		=> $password,
			"client_id" 	=> Request::getClientIp(),
			"client_key" 	=> Config::get('app.key')
		];

		// Uncomment this bloc when webservice is ready
		$request = [
			'url' 			=> "http://api.mellifera.cu.cc/signup",
			'description' 	=> [ "email","password","client_id","client_key" ],
			'params' 		=> json_encode( $user ),
			'headers' 		=> [ 'Content-type: application/json' ]
		];
		$client 	= new HttpClient;
		$response 	= $client->post( $request );
		return $response->json();
	}
	*/
}
