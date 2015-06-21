<?php
use Vinelab\Http\Client as HttpClient;

/**
 * Person Object
 */
class Person
{
    public $id                  = null;
    public $last_name           = null;
    public $first_name          = null;
    public $address1            = null;
    public $address2            = null;
    public $postcode            = null;
    public $city                = null;
    public $phone               = null;
    public $email               = null;
    public $notes               = null;
    public $user                = null;
    public $trades_with_sellers = null;
    public $trades_with_buyers  = null;


    public function __construct()
    {
        $args   = func_get_args();
        $number = func_num_args();
        if (method_exists($this,$func = '__construct' . $number)) {
            call_user_func_array([$this, $func], $args);
        }
    }

    public function __construct1($index)
    {
        $person_ws = BeeTools::cleanElement(Person::get($index));

        $this->id                  = $person_ws->id;
        $this->last_name           = isset($person_ws->last_name) ? $person_ws->last_name : null;
        $this->first_name          = isset($person_ws->first_name) ? $person_ws->first_name : null;
        $this->address1            = isset($person_ws->address1) ? $person_ws->address1 : null;
        $this->address2            = isset($person_ws->address2) ? $person_ws->address2 : null;
        $this->postcode            = isset($person_ws->postcode) ? $person_ws->postcode : null;
        $this->city                = isset($person_ws->city) ? $person_ws->city : null;
        $this->phone               = isset($person_ws->phone) ? $person_ws->phone : null;
        $this->email               = isset($person_ws->email) ? $person_ws->email : null;
        $this->notes               = isset($person_ws->notes) ? $person_ws->notes : null;
        $this->user                = isset($person_ws->user) ? $person_ws->user : null;
        $this->trades_with_sellers = isset($person_ws->trades_with_sellers) ? $person_ws->trades_with_sellers : null;
        $this->trades_with_buyers  = isset($person_ws->trades_with_buyers) ? $person_ws->trades_with_buyers : null;

    }

    /**
     * Getter for Persons
     * @param  integer $index identifiant de la personne demandée (optionnal)
     * @return mixed Person object | array of Person objects
     */
    public static function get($index = null)
    {
        $client     = new HttpClient;
        $response   = $client->get( [
                                        'url' => Config::get( 'app.api' ) . 'atomic/persons' . ( is_null( $index ) ? '' : '/' . $index ),
                                        'headers'   => ['Content-type: application/json','APIKEY:' . \Session::get( 'api_token' ) ]
                                    ] );
        return $response->json();
    }
}
