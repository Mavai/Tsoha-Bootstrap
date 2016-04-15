<?php

class SubjectController extends BaseController {

    public static function index($id) {
        $subjects = Subject::findAllIn($id);
        $course = Course::findId($id);
        Kint::dump($subjects);

        View::make('subject/index.html', array('aiheet' => $subjects, 'course' => $course));
    }

    public static function show($id) {
        $subject = Subject::findId($id);

        View::make('subject/show.html', array('subject' => $subject));
    }

    public static function store($id) {
        $params = $_POST;

        $attributes = array(
            'name' => $params['name'],
            'difficulty' => $params['difficulty'],
            'maxgrade' => $params['maxgrade'],
            'description' => $params['description'],
            'course_id' => $id
        );
        $subject = new Subject($attributes);
        $errors = $subject->errors();

        if (count($errors) == 0) {
            $subject->save();
            Redirect::to('/aihe/' . $subject->id);
        } else {
            $course = Course::findId($id);
            View::make('subject/new.html', array('course' => $course, 'errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function create($id) {
        $course = Course::findId($id);
        View::make('subject/new.html', array('course' => $course));
    }

}
