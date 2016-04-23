<?php

class SubjectController extends BaseController {

    public static function index($id) {
        $subjects = Subject::findAllIn($id);
        $course = Course::findId($id);

        View::make('subject/index.html', array('aiheet' => $subjects, 'course' => $course));
    }

    public static function show($id) {
        $subject = Subject::findId($id);
        $assignments = Assignment::findAllIn($subject->id);
        Kint::dump($assignments);

        View::make('subject/show.html', array('subject' => $subject, 'assignments' => $assignments));
    }

    public static function store($id) {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'name' => $params['name'],
            'difficulty' => $params['difficulty'],
            'maxgrade' => $params['maxgrade'],
            'description' => $params['description'],
            'course_id' => $id,
            'course' => Course::findId($id)
        );
        $subject = new Subject($attributes);
        $errors = $subject->errors();

        if (count($errors) == 0) {
            $subject->save();
            Redirect::to('/aihe/' . $subject->id, array('message' => 'Aihe lisätty onnistuneesti.'));
        } else {
            $course = Course::findId($id);
            $difficulties = array('Helppo', 'Keskitasoa', 'Vaikea');
            $maxgrades = array(1, 2, 3, 4, 5);
            View::make('subject/new.html', array('course' => $course, 'errors' => $errors, 'attributes' => $attributes, 'difficulties' => $difficulties, 'maxgrades' => $maxgrades));
        }
    }

    public static function create($id) {
        self::check_logged_in();
        $course = Course::findId($id);
        $difficulties = array('Helppo', 'Keskitasoa', 'Vaikea');
        $maxgrades = array(1, 2, 3, 4, 5);
        View::make('subject/new.html', array('course' => $course, 'difficulties' => $difficulties, 'maxgrades' => $maxgrades));
    }

    public static function edit($id) {
        self::check_logged_in();
        $subject = Subject::findId($id);
        $difficulties = array('Helppo', 'Keskitasoa', 'Vaikea');
        $maxgrades = array(1, 2, 3, 4, 5);
        View::make('subject/edit.html', array('attributes' => $subject, 'difficulties' => $difficulties, 'maxgrades' => $maxgrades));
    }

    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'difficulty' => $params['difficulty'],
            'maxgrade' => $params['maxgrade'],
            'description' => $params['description'],
        );

        $subject = new Subject($attributes);
        $errors = $subject->errors();

        if (count($errors) > 0) {
            $difficulties = array('Helppo', 'Keskitasoa', 'Vaikea');
            $maxgrades = array(1, 2, 3, 4, 5);
            View::make('subject/edit.html', array('errors' => $errors, 'attributes' => $attributes, 'difficulties' => $difficulties, 'maxgrades' => $maxgrades));
        } else {
            $subject->update();
            Redirect::to('/aihe/' . $subject->id, array('message' => 'Aihe päivitetty onnistuneesti.'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $course_id = Subject::findId($id)->course->id;
        $name = Subject::findId($id)->name;
        $subject = new Subject(array('id' => $id));
        $subject->destroy();

        Redirect::to('/aiheet/' . $course_id, array('message' => $name . ' poistettiin onnistuneesti.'));
    }

}
