<?php

class CourseController extends BaseController {

    public static function index() {
        $courses = Course::findAll();
        $counts = array();
        foreach ($courses as $course) {
            $subjects = Subject::findAllIn($course->id);
            $counts[$course->id] = count($subjects);
        }

        View::make('course/index.html', array('courses' => $courses, 'counts' => $counts));
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'name' => $params['name']
        );
        $course = new Course($attributes);
        $errors = $course->errors();

        if (count($errors) == 0) {
            $course->save();
            Redirect::to('/kurssit', array('message' => 'Aihe lisätty onnistuneesti.'));
        } else {
            $courses = Course::findAll();
            $counts = array();
            foreach ($courses as $course) {
                $subjects = Subject::findAllIn($course->id);
                $counts[$course->id] = count($subjects);
            }
            
            View::make('course/index.html', array('error' => true, 'errors' => $errors, 'attributes' => $attributes, 'courses' => $courses, 'counts' => $counts));
        }
    }
    
    public static function destroy($id) {
        self::check_logged_in();
        $name = Course::findId($id)->name;
        $course = new Course(array('id' => $id));
        $course->destroy();

        Redirect::to('/kurssit', array('message' => $name . ' poistettiin onnistuneesti.'));
    }

}
