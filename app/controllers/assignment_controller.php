<?php

class AssignmentController extends BaseController {

    public static function show($id) {
        $assignment = Assignment::findId($id);
        Kint::dump($assignment);
        
        View::make('assignment/show.html', array('assignment' => $assignment));
    }

    public static function create() {
        $statuses = array('Kesken', 'Valmis', 'Keskeytetty');
        $grades = array('', 0, 1, 2, 3, 4, 5);
        View::make('assignment/new.html', array('statuses' => $statuses, 'grades' => $grades));
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;
        
        if (Student::findId($params['studentnumber']) == NULL) {
            $student = new Student(array('name' => $params['name'], 'studentnumber' => $params['studentnumber']));
            $student->save();
        } else {
            $student = Student::findId($params['studentnumber']);
        }
        Kint::dump($params);
        
        if ($params['enddate'] == '') {
            $enddate = NULL;
        } else {
            $enddate = $params['enddate'];
        }
        
        if ($params['grade'] == '') {
            $grade = NULL;
        } else {
            $grade = $params['grade'];
        }
        $attributes = array(
            'begindate' => $params['begindate'],
            'enddate' => $enddate,
            'status' => $params['status'],
            'grade' => $grade,
            'subject' => Subject::findId($_GET['subjectid']),
            'student' => $student,
            'teacher' => User::findId($_GET['userid'])
        );
        $assignment = new Assignment($attributes);
        $errors = $assignment->errors();
        Kint::dump($attributes);
        Kint::dump($assignment);
        
        if (count($errors) == 0) {
            $assignment->save();
            Redirect::to('/suoritus/' . $assignment->id, array('message' => 'Suoritus lisätty onnistuneesti.'));
        } else {
            $statuses = array('Kesken', 'Valmis', 'Keskeytetty');
            $grades = array('', 0, 1, 2, 3, 4, 5);
            View::make('assignment/new.html', array('errors' => $errors, 'attributes' => $attributes, 'statuses' => $statuses, 'grades' => $grades));
        }
    }

}
