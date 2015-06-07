<?php namespace Mellifera\Mauth;

use Illuminate\Auth\UserInterface;

class MauthUser implements UserInterface{

	protected $token 	= "";
	protected $user 	= null;
	public $id 			= null;
	public $email 		= '';
	public $person 		= null;
	public $group 		= null;
	public $is_owner 	= false;

	public function __construct( \Illuminate\Auth\GenericUser $user ){
		$this->user 	= $user;
		$this->id 		= $user->id;
		$this->email 	= $user->email;
		$this->username = $user->email;
		$this->token 	= $user->token;
		$this->person 	= $user->person;
		$this->group 	= $user->group;
		$this->is_owner = $user->is_owner;
	}

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		if( !is_null( $this->user ) )
			return $this->user->id;
		else
			return false;
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return null;
	}


	/**
	 * NOT IMPLEMENTED
	 */

	public function setRememberToken($value){}
	public function getRememberToken(){}
	public function getRememberTokenName(){}
}



?>
