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

			$request = [
				'url' 		=> "http://api.mellifera.cu.cc/signin",
				'params' 	=> json_encode( $cred ),
				'headers' 	=> ['Content-type: application/json;']
			];
			$client 	= new HttpClient;
			$response 	= $client->post( $request );

			if( ! \BeeTools::is_error( $response ) ){
				$data = $response->json();

				$user = new \Illuminate\Auth\GenericUser( [
					'id' 		=> $data->id, 		// 303
					'email' 	=> $data->email, 	// test@impermanenceweb.fr
					'token' 	=> $data->token, 	// 0fb57035063f7c44c624a78a371727c5
					'person' 	=> $data->person, 	// null
					'group' 	=> $data->group, 	// 322
					'is_owner' 	=> false
					] );
				\Session::put('api_token', $data->token );
				\Session::flash( 'message', trans( 'users.welcome') );
			}else{
				$data = $response->json();

				// ############################# Stand by
				// Flash provisoire dans l'attente d'un code d'erreur dans le retour json du webservice
				// \Session::flash( 'message', \BeeTools::error_code( $data->code ) );

				\Session::flash( 'message', $data->message );
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

		$this->user = $user;
		return true;
	}

	/**
	 * Récupère l'ensemble des données propre à un utilisateur
	 * @param  integer $id identifiant de l'utilisateur
	 * @return MautUser Objet utilisateur spécifique à l'application
	 */
	public function retrieveById( $id ) {

		$user = null;
		$group= null;
		$person=null;
		$request = [
				'url' 		=> "http://api.mellifera.cu.cc/atomic/users/" . $id,
				'headers' 	=> ['Content-type: application/json;','APIKEY:' . \Session::get( 'api_token' ) ]
			];
		$client 	= new HttpClient;
		$response 	= $client->get( $request );
		$data 		= $response->json();

		if( ! empty ( $data ) ){

			if( ! is_null( $data->group ) )
				$group 		= \User::get_group( $data->group->id );
			else
				$group = null;

			if( ! is_null( $data->person ) )
				$person 	= \User::get_person( $data->person->id );
			else
				$person = null;

			$user 	= new \Illuminate\Auth\GenericUser( [
						'id' 		=> $data->id,
						'email' 	=> $data->email,
						'token' 	=> $data->token,
						'person' 	=> $person,
						'group' 	=> $group,
						'is_owner' 	=> ( ! is_null( $group ) && $data->id === $group->owner->id ? true : false )
					] );
		}

		if( ! is_null( $user ) )
			return new MauthUser( $user );
		else{
			return null;
		}
	}


	/**
	 * NOT IMPLEMENTED
	 */

	public function retrieveByToken( $id, $token ) {
		return new \Exception( 'not implemented' );
	}

	public function updateRememberToken( UserInterface $user, $token ) {
		return new \Exception( 'not implemented' );
	}
}
?>
