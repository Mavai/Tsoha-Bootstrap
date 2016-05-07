<?php

class TeacherController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $teachers = User::findAll();
        View::make('teacher/index.html', array('teachers' => $teachers));
    }

    public static function create() {
        View::make('teacher/new.html');
    }

    public static function store() {
        $params = $_POST;

        $attributes = array(
            'name' => $params['name'],
            'password' => $params['password']
        );
        $user = new User($attributes);
        $errors = array();

        if ($params['password'] != $params['password2']) {
            $errors[] = 'Salasanat eivät täsmää';
        }
        $errors = array_merge($errors, $user->errors());

        if (count($errors) == 0) {
            $user->save();
            Redirect::to('', array('Reskisteröinti onnistui'));
        } else {
            View::make('teacher/new.html', array('attributes' => $attributes, 'errors' => $errors));
        }
    }

    public static function edit($id) {
        self::check_logged_in();
        $teacher = User::findId($id);
        View::make('teacher/edit.html', array('attributes' => $teacher));
    }

    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'password' => $params['password']
        );

        $teacher = new User($attributes);
        $errors = $teacher->errors();

        if (count($errors) > 0) {
            View::make('teacher/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $teacher->update();
            Redirect::to('/opettajat', array('message' => 'Tiedot päivitetty onnistuneesti.'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $teacher = new User(array('id' => $id));
        $errors = array();
        if (self::get_user_logged_in()->id == $id) {
            $errors[] = 'Et voi poistaa itseäsi.';
        }

        if (count($errors) > 0) {
            $teachers = User::findAll();
            View::make('teacher/index.html', array('errors' => $errors, 'teachers' => $teachers));
        } else {
            $teacher->destroy();
            Redirect::to('/opettajat', array('message' => 'Opettaja poistettiin onnistuneesti.'));
        }
    }

}
