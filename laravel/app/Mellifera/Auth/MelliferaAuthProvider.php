<?php

namespace Mellifera\Auth;

use Illuminate\Auth\UserProviderInterface;
use	Illuminate\Auth\GenericUser;
use	Illuminate\Auth\UserInterface;
use Vinelab\Http\Client as HttpClient;

class MelliferaAuthProvider implements UserProviderInterface {
	/**
	* Webservice externe
	*/
	private $webservice;

	/**
	* Renvoie un utilisateur quand on lui fournit un id
	*
	* @param int $id
	* @return null|array
	*/
	public function retrieveById($id) {
//		$this->user = is_null($this->user) ? $this->MelliferaUser($id) : this->user;
		return $this->MelliferaUser($id);
	}	

	/**
	* Essaie de trouver un User correspondant aux paramètres passés
	*  @param login|pass
	* @return null|UserInterface
	*/
	public function retrieveByCredentials(array $cred) {
		//dd("RetrieveByCredentials : CREDENTIALS : ".$cred['email']);
//		if(!$user = $this->webservice->find($cred['login'])) { return null; }
		if(!empty($cred['email']) ) {
//http://api.mellifera.cu.cc/query/users?matchStringField=email&matchString=.$cred['email']


		$request = [
			'url' 		=> "http://api.mellifera.cu.cc/query/users?matchStringField=email&matchString=".$cred['email'],
			//'url' 		=> "http://api.mellifera.cu.cc/signin",
			//'params' 	=> json_encode( $cred ),
			//'params' 	=> json_encode($cred), // DEGAGER EN GET
			'headers' 	=> ['Content-type: application/json' ]
		];
		$client 	= new HttpClient;
		//$response 	= $client->post( $request ); // QUAND LE WEBS FONCTIONNERA
		$response 	= $client->get( $request );

		$json = json_decode($response->content())[0];
		//return $this->MelliferaUser($cred);
		dd( $json->id === 1232 );
		//dd(print_r($cred).print_r($response));

		}
		// pour l'instant :
//		return null;
	}

	/**
	* Valide les identifiants en les comparant à ceux passés au webservice
	*
	* @param UserInterface $user
	* @param array $cred
	* @return bool
	*/
	public function validateCredentials(\Illuminate\Auth\UserInterface $user, array $cred) {
		// pour l'instant
//		return $this->webservice->validateCredentials($cred['pass'], $user->password);
		//return $cred['password'] == $user->pass;
		dd("ValidateCredentials - USER : ".print_r($user)."    MelliUser : ".print_r($cred));
	}




	/**
	* Renvoie l'utilisateur d'id $id
	* @param int $id
	* @return GenericUser
	*/
	public function MelliferaUser($id) {
		$request = [
			'url' 		=> "http://api.mellifera.cu.cc/users/".$id,
		//	'params' 	=> json_encode( $entity ),
			'headers' 	=> ['Content-type: application/json' ]
		];
		$client 	= new HttpClient;
		$response 	= $client->get( $request );

		dd("MelliferaUserFromID : ".$response);
		
		json_decode($response->content())[0];
		
		return $this->MelliferaUser($cred);
		return new GenericUser([
			'id' => '1',
			'email' => 'a@a.aaa',
			'password' => '123123123',
			]);
	}





	public function retrieveByToken($id, $token) {
		return new \Exception('not implemented');
	}	

	public function updateRememberToken(UserInterface $user, $token) {
		return new \Exception('not implemented');	
	}

}
