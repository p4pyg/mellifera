<?php
use Vinelab\Http\Client as HttpClient;

class Hive {


	/**
	 * Getter for type of hives
	 * @return Array types of hives
	 */
	static public function get_types(){
		return $types = [ 'Ronde', 'Bâtisse chaude', 'Bâtisse froide', 'Warré', 'WBC', 'Langstroth', 'Dadant'];
	}

	static public function get( $id = null ){
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/atomic/hives" . ( is_null( $id ) ? '' : '/' . $id ) ] );
		return $response->json();
	}
}