<?php

class AssignmentController extends BaseController {
    
    public static function show($id) {
        $assignment = Assignment::findId($id);
        Kint::dump($assignment);
        
        View::make('assignment/show.html', array('assignment' => $assignment));
    }
    
    public static function create() {
        $statuses = array('Kesken', 'Valmis', 'Keskeytetty');
        $grades = array(0,1,2,3,4,5);
        View::make('assignment/new.html', array('statuses' => $statuses, 'grades' => $grades));
    }
}

