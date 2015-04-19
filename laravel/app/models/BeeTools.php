<?php
use Vinelab\Http\Client as HttpClient;

class BeeTools {


	/**
	 * Helper combo
	 * Transform entity name (first letter uppercase singular) to table name (full lowercase plural)
	 * @param  [string] $string [name of entity]
	 * @return [string]         [name of table]
	 */
	static public function entity_table( $string )
	{
		return mb_strtolower( str_plural( $string ) );
	}

	/**
	 * Helper combo
	 * Transform table name (full lowercase plural) to entity name (first letter uppercase singular)
	 * @param  [string] $string [name of table]
	 * @return [string]         [name of entity]
	 */
	static public function table_entity( $string )
	{
		return ucfirst( str_singular( $string ) );
	}

	/**
	 * Refactoring for controllers
	 * Store method
	 * @param  [array]  $data   [array of data from form]
	 * @param  [string] $string [object name]
	 * @return [object]         [response]
	 */
	static public function entity_store( $data, $string )
	{
		$entity = [];
		foreach ( $data as $key => $item )
			$entity[$key] = $item === '' ? null : $item;
		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/" . $string,
			'params' 	=> json_encode( $entity ),
			'headers' 	=> ['Content-type: application/json' ]
		];
		$client 	= new HttpClient;
		$response 	= $client->post( $request );
		return $response->json();
	}

	/**
	 * Refactoring for controllers
	 * Update method
	 * @param  [array]  $data   [array of data from form]
	 * @param  [string] $string [object name]
	 * @return [object]         [response]
	 */
	static public function entity_update( $data, $string )
	{
		$entity = [];
		foreach ( $data as $key => $item )
			$entity[$key] = $item === '' ? null : $item;
		$request = [
			'url' 		=> "https://bee-mellifera.herokuapp.com/" . $string,
			'params' 	=>  json_encode( $entity ),
			'headers' 	=> ['Content-type: application/json' ]
		];
		$client 	= new HttpClient;
		$response 	= $client->put( $request );
		return $response->json();
	}

	/**
	 * Refactoring for controllers
	 * Delete method
	 * @param  [int]    $id     [object id]
	 * @param  [string] $string [object name]
	 * @return [object]         [response]
	 */
	static public function entity_delete( $id, $string )
	{
		$url 	= "https://bee-mellifera.herokuapp.com/" . $string . "/" . $id;
		$json 	= '{}';
		$ch 	= curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "DELETE" );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $json );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		$result 	= curl_exec( $ch );
		$response 	= json_decode( $result );
		curl_close( $ch );

		return $response;
	}
}
?>