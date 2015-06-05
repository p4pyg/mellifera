<?php
use Vinelab\Http\Client as HttpClient;

class Hive {

	static public function get( $id = null ){
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => Config::get( 'app.api' ) . 'atomic/beehives' . ( is_null( $id ) ? '' : '/' . $id ) ] );
		return $response->json();
	}
}
