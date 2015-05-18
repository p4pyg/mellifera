<?php
use Vinelab\Http\Client as HttpClient;

class UserController extends \BaseController {

	public function signup() {
		return View::make('register');
	}

	public function create() {
		$validator = Validator::make(Input::all(), User::$rules);

		if($validator->passes()) {
			$user = new User;
			$user->email = Input::get('email');
			// TODO : faire fonctionner Hash::make() ou mcrypt()
			//$user->pass = mcrypt(Input::get('pass'));
			//$user->pass = Hash::make(Input::get('pass'));
			$user->password = Input::get('password');
			$user->client_id = "id";
			$user->client_key = Config::get('app.key');
			//dd($user);
			//$user->person = {};

			$request = [
				'url' 		=> "http://api.mellifera.cu.cc/signup",
				'params' 	=> json_encode($user),
				'headers' 	=> ['Content-type: application/json' ]
			];
			$client 	= new HttpClient;
			$response 	= $client->post( $request );

			return Redirect::to('login')->with('message', 'Merci, votre inscription a bien été prise en compte');
		} else {
			return Redirect::to('signup')->with('message','Des erreurs de validation sont constatées')->withErrors($validator)->withInput();
		} // if validator

	} // postCreate






	public function login() {
		return View::make('login');
	}

	public function signin() {
		if(Auth::attempt(array(
			'email'=>Input::get('email'),
			'password'=>Input::get('password'),
			'client_id'=> "id",
			'client_key'=> Config::get('app.key')
			))) {
			return Redirect::to('signup')->with('message', 'Bienvenue !');
		} else {
			return Redirect::to('signin')
			->with('message', 'Vous avez entré un mauvais Login/Mot de passe')
			->withInput();
		}
	}


} // UserController