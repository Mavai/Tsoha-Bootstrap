<?php

class AssignmentController extends BaseController {

    public static function show($id) {
        $assignment = Assignment::findId($id);

        View::make('assignment/show.html', array('assignment' => $assignment));
    }

    public static function create() {
        $statuses = array('Kesken', 'Valmis', 'Keskeytetty');
        $grades = array('', 0, 1, 2, 3, 4, 5);
        View::make('assignment/new.html', array('statuses' => $statuses, 'grades' => $grades, 'today' => date("Y-m-d"), 'subject' => $_GET['subjectid']));
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;

        $student = new Student(array('name' => $params['name'], 'studentnumber' => $params['studentnumber']));

        if ($params['grade'] == '') {
            $grade = NULL;
        } else {
            $grade = $params['grade'];
        }

        $attributes = array(
            'begindate' => $params['begindate'],
            'enddate' => $params['enddate'],
            'status' => $params['status'],
            'grade' => $grade,
            'subject' => Subject::findId($_GET['subjectid']),
            'student' => $params['studentnumber'],
            'teacher' => User::findId($_GET['userid']),
            'studentnumber' => $params['studentnumber'],
            'name' => $params['name']
        );
        $assignment = new Assignment($attributes);
        $errors = $assignment->errors();
        $errors = array_merge($errors, $student->errors());

        if (count($errors) == 0) {
            if (Student::findId($params['studentnumber']) == NULL) {
                $student->save();
            }
            $assignment->save();
            Redirect::to('/suoritus/' . $assignment->id, array('message' => 'Suoritus lisätty onnistuneesti.'));
        } else {
            $statuses = array('Kesken', 'Valmis', 'Keskeytetty');
            $grades = array('', 0, 1, 2, 3, 4, 5);
            View::make('assignment/new.html', array('errors' => $errors, 'attributes' => $attributes, 'statuses' => $statuses, 'grades' => $grades));
        }
    }
    
    public static function destroy($id) {
        self::check_logged_in();
        $assignment = Assignment::findId($id);
        $subjectid = $assignment->subject->id;
        $assignment->destroy();

        Redirect::to('/aihe/' . $subjectid, array('message' => 'Suoritus poistettiin onnistuneesti.'));
    }

}
