<?php

class SubjectController extends BaseController {

    public static function index($id) {
        $subjects = Subject::findAllIn($id);
        $course = Course::findId($id);

        View::make('subject/index.html', array('aiheet' => $subjects, 'course' => $course));
    }

    public static function show($id) {
        $subject = Subject::findId($id);

        View::make('subject/show.html', array('subject' => $subject));
    }

    public static function store($id) {
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
            View::make('subject/new.html', array('course' => $course, 'errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function create($id) {
        $course = Course::findId($id);
        View::make('subject/new.html', array('course' => $course));
    }
    
    public static function edit($id) {
        $subject = Subject::findId($id);
        View::make('subject/edit.html', array('attributes' => $subject));
    }
    
    public static function update($id) {
        $params = $_POST;
        
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
            View::make('subject/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $subject->update();
            Redirect::to('/aihe/' . $subject->id, array('message' => 'Aihe päivitetty onnistuneesti.'));
        }
        
    }
    
    public static function destroy($id) {
        $course_id = Subject::findId($id)->course->id;
        $name = Subject::findId($id)->name;
        $subject = new Subject(array('id' => $id));
        $subject->destroy();
        
        Redirect::to('/aiheet/' . $course_id, array('message' => $name . ' poistettiin onnistuneesti.'));
    }

}
