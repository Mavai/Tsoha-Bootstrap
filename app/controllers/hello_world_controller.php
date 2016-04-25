<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('home.html');
    }

    public static function sandbox() {
        $var = null;
        View::make('helloworld.html', array('var' => $var));
    }

    public static function etusivu() {
        View::make('suunnitelmat/etusivu.html');
    }

    public static function kurssit() {
        View::make('suunnitelmat/kurssi_lista.html');
    }

    public static function aiheet() {
        View::make('suunnitelmat/aihe_lista.html');
    }

    public static function aiheInfo() {
        View::make('suunnitelmat/info_sivu.html');
    }

    public static function aiheenMuokkaus() {
        View::make('suunnitelmat/aiheen_muokkaus.html');
    }

    public static function kurssinLisays() {
        View::make('suunnitelmat/kurssin_lisays.html');
    }

    public static function aiheenLisays() {
        View::make('suunnitelmat/aiheen_lisays.html');
    }

}
