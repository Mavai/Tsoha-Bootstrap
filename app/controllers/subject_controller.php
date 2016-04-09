<?php

class SubjectController extends BaseController {
    
    public static function index() {
        $subjects = Subject::findAll();
        
        View::make('subject/index.html', array('aiheet' => $subjects));
    }
}

