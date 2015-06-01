<?php namespace Mellifera\Mauth;

use Illuminate\Auth\UserProviderInterface;
use Illuminate\Auth\UserInterface;
use Vinelab\Http\Client as HttpClient;

class MauthUserProvider implements UserProviderInterface{

	protected $user;
	/**
	 * Essaie de trouver un User correspondant aux paramètres passés
	 * @param array [email,password,client_id,client_key]
	 * @return null|UserInterface
	 */
	public function retrieveByCredentials( array $cred ) {


		if( !empty( $cred['email'] ) ) {



			// ################ Attente gestion de la route signin pour authentification
			$request = [
				'url' 		=> "http://api.mellifera.cu.cc/signin",
				'params' 	=> json_encode( $cred ),
				'headers' 	=> ['Content-type: application/json; APIKEY:' . $cred['client_key'] ]
			];
			$client 	= new HttpClient;
			$response 	= $client->post( $request );


			// ################ JSON attendu en cas de succés HEADER HTTP CODE 200
			// $response_header 	= 200;
			//$response 	= '{"user":{"id":8,"name":"contact","email":"contact@impermanenceweb.fr"},"group":{"id":95,"owner":true},"token":"AF345EC9371B30A25"}';

			// ################ JSON attendu en cas d'erreur HEADER HTTP CODE 201 / 401
			// $response_header 	= 201;
			// $response 	= '{ "code" : 1 }';


			if( ! \BeeTools::is_error( $response ) ){
				$data = $response->json();
				$user = new GenericUser( [
					'user' => $data->user,
					'group'=> $data->group,
					'token'=> $data->token
					] );
				\Session::flash( 'message', trans( 'users.welcome') );
			}else{
				$data = $response->json();
				\Session::put( 'response', $data  ); // \BeeTools::error_code( $data->code )
				\Session::put( 'login_error', $data->message );
				return  null;
			}

			return $user;
		}
	}

	/**
	 * Valide les identifiants en les comparant à ceux passés au webservice
	 *
	 * @param UserInterface $user
	 * @param array $cred
	 * @return bool
	 */
	public function validateCredentials( \Illuminate\Auth\UserInterface $user, array $cred ) {

		// ################ Le webservice gère la validation
		// echo '<h3>ValidateCredentials - USER </h3>';
		// echo '<pre>';
		// print_r( $user );
		// echo '</pre>';
		// echo '<h3>MelliUser</h3>';
		// echo '<pre>';
		// print_r( $cred );
		// echo '</pre>';
		// die( '<p style="color:red; font-weight:bold;">Debug</p> Test authentification' );
		$this->user = $user;
		return true;
	}


	public function retrieveById( $id ) {
		return new \Exception( 'not implemented' );
	}

	public function retrieveByToken( $id, $token ) {
		return new \Exception( 'not implemented' );
	}

	public function updateRememberToken( UserInterface $user, $token ) {
		return new \Exception( 'not implemented' );
	}




}





 ?>