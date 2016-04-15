<?php

class Subject extends BaseModel {

    public $id, $name, $difficulty, $maxgrade, $description, $course_id, $validators;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_maxgrade');
    }

    public static function findAll() {
        $query = DB::connection()->prepare('SELECT * FROM Subject');

        $query->execute();

        $rows = $query->fetchAll();
        $subjects = array();

        foreach ($rows as $row) {
            $subjects[] = new Subject(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'difficulty' => $row['difficulty'],
                'maxgrade' => $row['maxgrade'],
                'description' => $row['description'],
                'course_id' => $row['course_id']
            ));
        }
        return $subjects;
    }

    public static function findId($id) {
        $query = DB::connection()->prepare('SELECT * FROM Subject WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $subject = new Subject(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'difficulty' => $row['difficulty'],
                'maxgrade' => $row['maxgrade'],
                'description' => $row['description'],
                'course_id' => $row['course_id']
            ));
            return $subject;
        }
        return null;
    }
    
    public static function findAllIn($courseId) {
        $query = DB::connection()->prepare('SELECT * FROM Subject WHERE course_id = :id');
        $query->execute(array('id' => $courseId));
        $rows = $query->fetchAll();
        
        $subjects = array();
        
        foreach ($rows as $row) {
            $subjects[] = new Subject(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'difficulty' => $row['difficulty'],
                'maxgrade' => $row['maxgrade'],
                'description' => $row['description'],
                'course_id' => $row['course_id']
            ));
        }
        return $subjects;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Subject (name, difficulty, maxgrade, description, course_id) '
                . 'VALUES (:name, :difficulty, :maxgrade, :description, :course_id) RETURNING id');
        $query->execute(array('name' => $this->name, 'difficulty' => $this->difficulty, 'maxgrade' => $this->maxgrade, 
            'description' => $this->description, 'course_id' => $this->course_id));
        
        $row = $query->fetch();
        
        $this->id = $row['id'];
    }
    
    public function validate_name() {
        $errors = array();
        if ($this->name == '' || $this->name == NULL) {
            $errors[] = 'Nimi ei saa olla tyhjä';
        }
        return $errors;
    }
    
    public function validate_maxgrade() {
        $errors = array();
        if ($this->maxgrade == '' || $this->maxgrade == NULL) {
            $errors[] = 'Anna arvosanamaksimi';
        }
        return $errors;
    }

}
