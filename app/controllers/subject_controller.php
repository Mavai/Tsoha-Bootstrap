<?php

class SubjectController extends BaseController {

    public static function index($id) {
        $subjectsOld = Subject::findAllIn($id);
        $course = Course::findId($id);
        $subjects = array();
        
        foreach ($subjectsOld as $subject) {
            $completioninfo = Subject::completionInfo($subject->id);
            $avg = Subject::avgGradeIn($subject->id);
            $subject = (array)$subject;
            $subject['avggrade'] = $avg;
            $subject['all'] = $completioninfo['all'];
            $subjects[] = $subject;
        }
        View::make('subject/index.html', array('aiheet' => $subjects, 'course' => $course));
    }

    public static function show($id) {
        $subject = Subject::findId($id);
        $assignments = Assignment::findAllInSubject($subject->id);
        $completionInfo = Subject::completionInfo($id);
        $avg = Subject::avgGradeIn($id);

        View::make('subject/show.html', array('subject' => $subject, 'assignments' => $assignments, 'completioninfo' => $completionInfo, 'avg' => $avg));
    }

    public static function store($id) {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'name' => $params['name'],
            'difficulty' => $params['difficulty'],
            'maxgrade' => $params['maxgrade'],
            'description' => $params['description'],
            'course_id' => $id,
            'course' => Course::findId($id)
        );
        $subject = new Subject($attributes);
        $errors = $subject->errors();

        if (count($errors) == 0) {
            $subject->save();
            Redirect::to('/aihe/' . $subject->id, array('message' => 'Aihe lisätty onnistuneesti.'));
        } else {
            $course = Course::findId($id);
            $difficulties = array('Helppo', 'Keskitasoa', 'Vaikea');
            $maxgrades = array(1, 2, 3, 4, 5);
            View::make('subject/new.html', array('course' => $course, 'errors' => $errors, 'attributes' => $attributes, 'difficulties' => $difficulties, 'maxgrades' => $maxgrades));
        }
    }

    public static function create($id) {
        self::check_logged_in();
        $course = Course::findId($id);
        $difficulties = array('Helppo', 'Keskitasoa', 'Vaikea');
        $maxgrades = array(1, 2, 3, 4, 5);
        View::make('subject/new.html', array('course' => $course, 'difficulties' => $difficulties, 'maxgrades' => $maxgrades));
    }

    public static function edit($id) {
        self::check_logged_in();
        $subject = Subject::findId($id);
        $difficulties = array('Helppo', 'Keskitasoa', 'Vaikea');
        $maxgrades = array(1, 2, 3, 4, 5);
        $name = $subject->name;
        View::make('subject/edit.html', array('attributes' => $subject, 'difficulties' => $difficulties, 'maxgrades' => $maxgrades, 'name' => $name));
    }

    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;
        $name = Subject::findId($id)->name;

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'difficulty' => $params['difficulty'],
            'maxgrade' => $params['maxgrade'],
            'description' => $params['description'],
        );

        $subject = new Subject($attributes);
        $errors = $subject->errors();

        if (count($errors) > 0) {
            $difficulties = array('Helppo', 'Keskitasoa', 'Vaikea');
            $maxgrades = array(1, 2, 3, 4, 5);
            View::make('subject/edit.html', array('errors' => $errors, 'attributes' => $attributes, 'difficulties' => $difficulties, 'maxgrades' => $maxgrades, 'name' => $name));
        } else {
            $subject->update();
            Redirect::to('/aihe/' . $subject->id, array('message' => 'Aihe päivitetty onnistuneesti.'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $course_id = Subject::findId($id)->course->id;
        $name = Subject::findId($id)->name;
        $subject = new Subject(array('id' => $id));
        $subject->destroy();

        Redirect::to('/aiheet/' . $course_id, array('message' => $name . ' poistettiin onnistuneesti.'));
    }
    
    public static function summary($courseId) {
        self::check_logged_as_ohjaaja();
        $subjectsOld = Subject::findTop10In($courseId);
        $course = Course::findId($courseId);
        $subjects = array();
        
        foreach ($subjectsOld as $subject) {
            $completioninfo = Subject::completionInfo($subject->id);
            $avg = Subject::avgGradeIn($subject->id);
            $subject = (array)$subject;
            $subject['avggrade'] = $avg;
            $subject['all'] = $completioninfo['all'];
            $subjects[] = $subject;
        }
        $info = Course::courseInfo($courseId);
        View::make('course/summary.html', array('subjects' => $subjects, 'course' => $course, 'info' => $info));
    }

}
