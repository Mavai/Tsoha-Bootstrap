<?php

class CourseController extends BaseController {
    
    public static function index() {
        $courses = Course::findAll();
        $counts = array();
        foreach ($courses as $course) {
            $subjects = Subject::findAllIn($course -> id);
            $counts[$course -> id] = count($subjects);
        }
        
        View::make('course/index.html', array('courses' => $courses, 'counts' => $counts));
    }
}

