<?php
use Vinelab\Http\Client as HttpClient;

class Race {

	static public function get( $id = null ){
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/atomic/races" . ( is_null( $id ) ? '' : '/' . $id ) ] );
		return $response->json();

	}



}