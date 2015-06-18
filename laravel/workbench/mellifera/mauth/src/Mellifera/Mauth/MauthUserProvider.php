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
				'url' 		=> \Config::get( 'app.api' ) . 'signin',
				'params' 	=> json_encode( $cred ),
				'headers' 	=> ['Content-type: application/json;']
			];
			$client 	= new HttpClient;
			$response 	= $client->post( $request );

			if( ! \BeeTools::is_error( $response ) ){
				$data = $response->json();

				$user = new \Illuminate\Auth\GenericUser( [
					'id' 		=> $data->id,
					'email' 	=> $data->email,
					'token' 	=> $data->token,
					'person' 	=> $data->person,
					'group' 	=> $data->group,
					'is_owner' 	=> false
					] );
				\Session::put('api_token', $data->token );
				\Session::flash( 'message', trans( 'users.welcome') );
			}else{
				if ($response->statusCode() == 502){
					\Session::flash('message', trans('tools.ws_error'));
					return null;
				}
				// ############################# Stand by
				// Flash provisoire dans l'attente d'un code d'erreur dans le retour json du webservice
				// \Session::flash( 'message', \BeeTools::error_code( $data->code ) );

				\Session::flash( 'message', $response->content() );
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
	 * @param  integer $index identifiant de l'utilisateur
	 * @return MautUser Objet utilisateur spécifique à l'application
	 */
	public function retrieveById( $index ) {

		$user = null;
		$group= null;
		$person=null;
		$request = [
				'url' 		=> \Config::get( 'app.api' ) . 'users/' . $index,
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

	public function retrieveByToken( $index, $token ) {
		return new \Exception( 'not implemented' );
	}

	public function updateRememberToken( UserInterface $user, $token ) {
		return new \Exception( 'not implemented' );
	}
}
?>
