<?php

class SubjectController extends BaseController {
    
    public static function index($id) {
        $subjects = Subject::findAllIn($id);
        
        View::make('subject/index.html', array('aiheet' => $subjects));
    }
    
    public static function show($id) {
        $subject = Subject::findId($id);
        
        View::make('subject/show.html', array('subject' => $subject));
    }
    
    public static function store() {
        $params = $_POST;
        
        $subject = new Subject(array(
            'name' => $params['name'],
            'difficulty' => $params['difficulty'],
            'maxgrade' => $params['maxgrade'],
            'description' => $params['description']
        ));
        
        $subject->save();
        
        Redirect::to('/aiheet');
    }
    
    public static function create() {
        View::make('subject/new.html');
    }
}

