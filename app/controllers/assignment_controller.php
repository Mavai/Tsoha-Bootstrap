<?php

class AssignmentController extends BaseController {
    
    public static function show($id) {
        $assignment = Assignment::findId($id);
        Kint::dump($assignment);
        
        View::make('assignment/show.html', array('assignment' => $assignment));
    }
}

