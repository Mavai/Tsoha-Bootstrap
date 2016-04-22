<?php

class UserController extends BaseController {
    public static function login() {
        View::make('login.html');
    }
    
    public static function handle_login() {
        $params = $_POST;
        
        $user = User::authenticate($params['username'], $params['password']);
        
        if (!$user) {
            View::make('login.html', array('error' => 'Väärä käyttäjätunnus tai salasana', 'username' => $params['username']));
        }
        $_SESSION['user'] = $user->id;
        
        Redirect::to('/', array('message' => 'Tervetuloa' . $user->name));
    }
    
    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/etusivu', array('message' => 'Olet kirjautunut ulos'));
    }
}

