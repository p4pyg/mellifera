<?php
use Vinelab\Http\Client as HttpClient;

class Hive {

	/**
	 * Getter for type of hives
	 * @return Response JSON Array merged datas types of hives
	 */
	static public function get_types(){
		$client 		= new HttpClient;
		$response 		= $client->get( [ 'url' => "http://api.mellifera.cu.cc/column/beehivetypes/label" ] );
		$top_types 		= $response->json();

		$response 		= $client->get( [ 'url' => "http://api.mellifera.cu.cc/column/beehives/beehive_type" ] );
		$custom_types 	= $response->json();

		$merged = array_merge( $top_types->datas, $custom_types->datas );

		foreach ( $merged as $key => $item )
			if( $item->value == ''|| is_null( $item->value ) )
				unset( $merged[ $key ] );

		return json_encode( $merged );
	}

	static public function get( $id = null ){
		$client 	= new HttpClient;
		$response 	= $client->get( [ 'url' => "http://api.mellifera.cu.cc/atomic/beehives" . ( is_null( $id ) ? '' : '/' . $id ) ] );
		return $response->json();
	}
}
