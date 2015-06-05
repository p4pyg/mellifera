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
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
	protected $hidden = array('remember_token');


	static public function get_group( $id = null ){
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . 'atomic/groups' . ( is_null( $id ) ? '' : '/' . $id ) ] );
		return $response->json();
	}
	static public function get_person( $id = null ){
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . 'atomic/persons' . ( is_null( $id ) ? '' : '/' . $id ) ] );
		return $response->json();
	}
}
