<?php

/**
 * Controller Home
 */
class HomeController extends \BaseController
{

    /**
     * Construction de la page d'accueil Backoffice
     * @return View home
     */
    public function index()
    {
        $apiaries_nb    = Apiary::getNumber();
        $hives_nb       = Hive::getNumber();
        $queens_nb      = Queen::getNumber();
        $swarms_nb      = Swarm::getNumber();
        return View::make('home', ['apiaries_nb' => $apiaries_nb, 'hives_nb' => $hives_nb, 'queens_nb' => $queens_nb, 'swarms_nb' => $swarms_nb]);
    }

    /**
     * Construction de la page d'accueil Landing
     */
    public function landing()
    {
        return View::make('landing.index');
    }

}