<?php

class StudentController extends BaseController {
    
    public static function index() {
        self::check_logged_in();
        $studentsOld = Student::findAll();
        $students = array();
        foreach($studentsOld as $student) {
            $assignmentcount = Student::info($student->studentnumber);
            $student = (array)$student;
            $student['assignmentcount'] = $assignmentcount;
            $students[] = $student;
        }
        View::make('student/index.html', array('students' => $students));
    }

    public static function show($studentnumber) {
        self::check_logged_in();
        $student = Student::findId($studentnumber);
        $assignments = Assignment::findAllInStudent($studentnumber);
        View::make('student/show.html', array('student' => $student, 'assignments' => $assignments));
    }
    
    public static function edit($studentnumber) {
        self::check_logged_in();
        $student = Student::findId($studentnumber);
        $assignments = Assignment::findAllInStudent($studentnumber);
        View::make('student/edit.html', array('attributes' => $student, 'assignments' => $assignments, 'studentnumber' => $student->studentnumber));
    }
    
    public static function update($studentnumber) {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'studentnumber' => $params['studentnumber'],
            'name' => $params['name']
        );

        $student = new Student($attributes);
        $errors = array();
        $check = Student::findId($params['studentnumber']);
        if ($check != NULL && $params['studentnumber'] != $studentnumber) {
            $errors[] = 'Tarkista opiskelijanumero.';
        }
        Kint::dump(Student::findId($params['studentnumber']));
        Kint::dump($params['studentnumber']);
        Kint::dump($studentnumber);
        $errors = array_merge($errors, $student->errors());
        

        if (count($errors) > 0) {
            View::make('student/edit.html', array('errors' => $errors, 'attributes' => $attributes, 'studentnumber' => $studentnumber));
        } else {
            $student->update($studentnumber);
            Redirect::to('/oppilas/' . $student->studentnumber, array('message' => 'Tiedot päivitetty onnistuneesti.'));
        }
    }
    
    public static function destroy($studentnumber) {
        self::check_logged_in();
        $student = new Student(array('studentnumber' => $studentnumber));
        $student->destroy();

        Redirect::to('/oppilaat', array('message' => 'Oppilas poistettiin onnistuneesti.'));
    }
}

