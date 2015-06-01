<?php namespace Mellifera\Mauth;

use Illuminate\Auth\UserInterface;

class MauthUser implements UserInterface{

	protected $token 	= "";
	protected $user 	= null;
	public $id 			= null;
	public $username 	= "";

	public function __construct( GenericUser $user ){
	    $this->user 	= $user;
	    $this->id 		= $user->id;
	    $this->username = $user->email;
	}

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->id;
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
	public function setRememberToken($value){}
	public function getRememberToken(){}
	public function getRememberTokenName(){}
}



?>