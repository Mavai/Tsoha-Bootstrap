<?php

class CourseController extends BaseController {
    
    public static function index() {
        $courses = Course::findAll();
        
        View::make('course/index.html', array('courses' => $courses));
    }
}

