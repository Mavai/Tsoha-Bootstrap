<?php

class BaseController {

    public static function get_user_logged_in() {
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user'];
            $user = User::findId($user_id);
            return $user;
        }
        return null;
    }

    public static function check_logged_in() {
        if (!isset($_SESSION['user'])) {
            Redirect::to('/login', array('error' => 'Sinun tulee ensin kirjautua sisään!'));
        }
    }

    public static function check_logged_as_admin() {
        if (!isset($_SESSION['user'])) {
            Redirect::to('/login', array('error' => 'Sinun tulee ensin kirjautua sisään!'));
        } else if (self::get_user_logged_in()->rights != 'Admin') {
            if (!isset($_SERVER['HTTP_REFERER'])) {
                $url = NULL;
            } else {
                $url = $_SERVER['HTTP_REFERER'];
            }
            if ($url == null) {
                $url = 'tsohaprojekti/';
            }
            $prev = explode('tsohaprojekti', $url);
            Redirect::to($prev[1], array('rightserror' => 'Oikeutesi eivät riitä tälle sivulle.'));
        }
    }
    
    public static function check_logged_as_ohjaaja() {
        if (!isset($_SESSION['user'])) {
            Redirect::to('/login', array('error' => 'Sinun tulee ensin kirjautua sisään!'));
        } else if (self::get_user_logged_in()->rights != 'Admin' && self::get_user_logged_in()->rights != 'Ohjaaja') {
            if (!isset($_SERVER['HTTP_REFERER'])) {
                $url = NULL;
            } else {
                $url = $_SERVER['HTTP_REFERER'];
            }
            if ($url == null) {
                $url = 'tsohaprojekti/';
            }
            $prev = explode('tsohaprojekti', $url);
            Redirect::to($prev[1], array('rightserror' => 'Oikeutesi eivät riitä tälle sivulle.'));
        }
    }

}
