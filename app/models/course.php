<?php

class Course extends BaseModel {
    
    public $id, $name, $subjectCount, $validators;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_name_length');
    }
    
    public static function findAll() {
        $query = DB::connection()->prepare('SELECT * FROM Course');

        $query->execute();

        $rows = $query->fetchAll();
        $courses = array();

        foreach ($rows as $row) {
            $courses[] = new Course(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
        }
        return $courses;
    }
    
    public static function findId($id) {
        $query = DB::connection()->prepare('SELECT * FROM Course WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $course = new Course(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
            return $course;
        }
        return null;
    }
    
    public static function courseInfo($id) {
        $query = DB::connection()->prepare('SELECT (SELECT COUNT (Assignment.id) FROM Assignment, Subject WHERE Subject.course_id = :id AND Assignment.subject_id = Subject.id) AS all, '
                . '(SELECT COUNT(Assignment.id) FROM Assignment, Subject WHERE Subject.course_id = :id AND Assignment.subject_id = Subject.id AND Assignment.status = \'Keskeytetty\') AS aborted,'
                . '(SELECT COUNT(Assignment.id) FROM Assignment, Subject WHERE Subject.course_id = :id AND Assignment.subject_id = Subject.id AND Assignment.grade = 0) AS failed,'
                . '(SELECT ROUND(AVG(Assignment.grade), 1) FROM Assignment, Subject WHERE Subject.course_id = :id AND Assignment.subject_id = Subject.id) AS avggrade');
        $query->execute(array(':id' => $id));
        $row = $query->fetch();
        $info = array('all' => $row['all'], 'aborted' => $row['aborted'], 'failed' => $row['failed'], 'avggrade' => $row['avggrade']);
        return $info;
    }


    public function save() {
        $query = DB::connection()->prepare('INSERT INTO course (name) VALUES (:name) RETURNING id');
        
        $query->execute(array('name' => $this->name));
        
        $row = $query->fetch();
        
        $this->id = $row['id'];
    }
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Course WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }
    
    public function validate_name() {
        $errors = array();
        if ($this->name == '' || $this->name == NULL) {
            $errors[] = 'Nimi ei saa olla tyhjä';
        }
        return $errors;
    }
    
    public function validate_name_length() {
        return parent::validate_string_length($this->name, 50, 'Nimi');
    }
}

