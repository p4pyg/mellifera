<?php
use Vinelab\Http\Client as HttpClient;

class BeeTools {


	/**
	 * Create or authenticate use
	 */
	static public function authenticate( $email, $password )
	{
		$user = [
			"email" 		=> $email,
			"password" 		=> $password,
			"client_id" 	=> Request::getClientIp(),
			"client_key" 	=> Config::get('app.key')
		];

		// Uncomment this bloc when webservice is ready
		// $request = [
		// 	'url' 			=> "http://api.mellifera.cu.cc/signin",
		// 	'description' 	=> [ "email","password","client_id","client_key" ],
		// 	'params' 		=> json_encode( $user ),
		// 	'headers' 		=> [ 'Content-type: application/json' ]
		// ];
		// $client 	= new HttpClient;
		// $response 	= $client->post( $request );
		// return $response->json();
		//
		// Delete this bloc when webservice is ready
		$response =
				'{
					"code":"201",
					"description": [ "user", "supervisor", "token" ],
					"data":[
						{	"@id": 1,
							"id" : 8,
							"name": "user",
							"etc": "..."
						},
						true,
						"AF345EC9371B30A25"
					]
				}';
		return json_decode( $response );
	}

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
	 * Helper list of month
	 * @return [array]
	 */
	static public function list_month( $index = null ){
		$months = [ trans( 'tools.jan' ), trans( 'tools.feb' ), trans( 'tools.mar' ), trans( 'tools.apr' ), trans( 'tools.may' ), trans( 'tools.jun' ), trans( 'tools.jul' ), trans( 'tools.aug' ), trans( 'tools.sept' ), trans( 'tools.oct' ), trans( 'tools.nov' ), trans( 'tools.dec' ) ];
		if( is_null( $index ) )
			return $months;
		return $months[ $index ];
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
			'url' 		=> "http://api.mellifera.cu.cc/" . $string,
			'params' 	=> json_encode( $entity ),
			'headers' 	=> ['Content-type: application/json' ]
		];
		$client 	= new HttpClient;
		$response 	= $client->post( $request );



		return $response;
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
			'url' 		=> "http://api.mellifera.cu.cc/" . $string,
			'params' 	=>  json_encode( $entity ),
			'headers' 	=> ['Content-type: application/json' ]
		];
		$client 	= new HttpClient;
		$response 	= $client->put( $request );
		return $response;
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
		$url 	= "http://api.mellifera.cu.cc/" . $string . "/" . $id;
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