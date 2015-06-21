<?php
use Vinelab\Http\Client as HttpClient;

class UserController extends \BaseController
{

    /**
     * Display signup form
     * @return View auth.register
     */
    public function signup()
    {
        return View::make('auth.register');
    }

    /**
     * Display login form
     * @return View auth.login
     */
    public function login()
    {
        return View::make('auth.login');
    }

    /**
     * Logout action
     * @return View backoffice.home
     */
    public function logout()
    {
        Auth::logout();
        Session::forget('api_token');
        return  Redirect::to('backoffice')->with('message', trans('users.logout'));
    }

    /**
     * Record authenticated user in session
     * @return Back with message confirm OR fail
     */
    public function signin()
    {
        // Add validator here
        if(Auth::attempt(['email'   => Input::get('email'),
                            'password'  => Input::get('password'),
                            'client_id' => Request::getClientIp(),
                            'client_key'=> Config::get('app.key')])
       ) {
            return Redirect::to('backoffice')->with('message', trans('users.welcome'));
        } else {
            if (Session::has('message')) {
                $message = Session::get('message');
            } else {
                $message = trans('users.login_error');
            }
            return Redirect::back()
            ->with('message', $message)
            ->withInput(Input::only('email'));
        }
    }

    /**
     * Display a listing of the users.
     * @return View users.index with all users
     */
    public function index()
    {
        $client     = new HttpClient;
        $response   = $client->get(['url' => Config::get('app.api') . "atomic/users", 'headers'     => ['Content-type: application/json','APIKEY:' . \Session::get('api_token')]]);
        $view       = BeeTools::isError($response);
        if($view){
            return $view;
        }
        $users  = $response->json();

        return View::make('users.index', ["users" => $users]);
    }

    /**
     * Display the specified user.
     *
     * @param  int  $index
     * @return Response
     */
    public function show($index)
    {
        // Todo
    }

    /**
     * Show the form for creating owner.
     * @return View users.form with user null
     */
    public function createOwner()
    {
        $validator = Validator::make(Input::all(), User::$rules);

        if($validator->passes()) {
            $user        = new User;
            $user->email = Input::get('email');

            $user->password     = Input::get('password');
            $user->client_id    = Request::getClientIp();
            $user->client_key   = Config::get('app.key');

            $request = [
                'url'       => Config::get('app.api') . "signup",
                'params'    => json_encode($user),
                'headers'   => ['Content-type: application/json']
           ];
            $client     = new HttpClient;

            // Add here the response test on create user !important
            $client->post($request);

            return Redirect::to('login')->with('message', 'users.signup_success');
        } else {
            return Redirect::to('signup')->with('message','users.signup_error')->withErrors($validator)->withInput();
        }
    }

    /**
     * Show the form for creating a new user.
     * @return View users.form with user null
     */
    public function create()
    {
        $user = null;
        return View::make('users.form', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified user.
     * @param  int  $index
     * @return View users.form with user
     */
    public function edit($index)
    {
        $client     = new HttpClient;
        $response   = $client->get(['url' => Config::get('app.api') . "atomic/users/" . $index, 'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get('api_token')]]);
        $view       = BeeTools::isError($response);
        if($view){
            return $view;
        }
        $user       = $response->json();
        return View::make('users.form', ['user' => $user]);
    }

    /**
     * Store a newly created user in storage.
     * Object structure for HTTP POST
     * $user = [
     *          "createdAt"             => [timestamp],
     *          "updatedAt"             => [timestamp],
     *          "characteristics"       => [object],
     *          "daugthers"             => [object],
     *          "sons"                  => [object],
     *          "files"                 => [object],
     *          "productions"           => [object],
     *          "association_date"      => [timestamp],
     *          "separation_date"       => [timestamp]
     *      ];
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make(Input::all(), User::$rules);

        if($validator->passes()) {
            $user        = new User;
            $user->email = Input::get('email');

            $user->password     = Input::get('password');
            $user->client_id    = Request::getClientIp();
            $user->client_key   = Config::get('app.key');
            $user->group        = ["id" => Auth::user()->group->id];


            $request = [
                'url'       => Config::get('app.api') . "signup",
                'params'    => json_encode($user),
                'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get('api_token')]
           ];
            $client     = new HttpClient;

            // Add here the response test on create user !important
            $response = $client->post($request);
            $view     = BeeTools::isError($response);
            if($view){
                return $view;
            }
            return Redirect::to('users')->with('message', 'users.signup_success');
        } else {
            return Redirect::back()->with('message','users.signup_error')->withErrors($validator)->withInput();
        }
    }

    /**
     * Update the specified user in storage.
     * Object structure for HTTP PUT
     * $user = [
     *          "id"                    => [integer][notnull],
     *          "createdAt"             => [timestamp],
     *          "updatedAt"             => [timestamp],
     *          "characteristics"       => [object],
     *          "daugthers"             => [object],
     *          "sons"                  => [object],
     *          "files"                 => [object],
     *          "productions"           => [object],
     *          "association_date"      => [timestamp],
     *          "separation_date"       => [timestamp]
     *      ];
     * @param  int  $index
     * @return Response
     */
    public function update($index)
    {
        $user           = Input::except('_token');
        $user['id'] = (int) $index;
        $response       = BeeTools::entityUpdate($user, 'users');
        $view       = BeeTools::isError($response);
        if($view){
            return $view;
        }
        return Redirect::to('users');
    }

    /**
     * Remove the specified user from storage.
     * @param  int  $index
     * @return Response
     */
    public function delete($index)
    {
        BeeTools::entityDelete($index, 'users');
        return Redirect::to('users');
    }
}
