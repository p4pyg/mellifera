<?php
use Vinelab\Http\Client as HttpClient;

class Race {

	protected $race = null;
	/**
	 * Getter for unique Race
	 * @param  integer $id identifiant de la race demandée
	 * @return Race object
	 */
	static public function get( $id = null ){
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . 'atomic/races' . ( is_null( $id ) ? '' : '/' . $id ) ] );
		return $response->json();
	}
}