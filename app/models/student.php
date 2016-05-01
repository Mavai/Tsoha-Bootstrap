<?php

class Student extends BaseModel {

    public $studentnumber, $name, $validators;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_studentnumber', 'validate_authentity', 'validate_name');
    }

    public static function findAll() {
        $query = DB::connection()->prepare('SELECT * FROM Student');

        $query->execute();

        $rows = $query->fetchAll();
        $students = array();

        foreach ($rows as $row) {
            $students[] = new Student(array(
                'studentnumber' => $row['studentnumber'],
                'name' => $row['name']
            ));
        }
        return $students;
    }

    public static function findId($studentnumber) {
        $query = DB::connection()->prepare('SELECT * FROM Student WHERE studentnumber = :studentnumber LIMIT 1');
        $query->execute(array('studentnumber' => $studentnumber));
        $row = $query->fetch();

        if ($row) {
            $student = new Student(array(
                'studentnumber' => $row['studentnumber'],
                'name' => $row['name']
            ));
            return $student;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Student (studentnumber, name) VALUES (:studentnumber, :name)');
        $query->bindValue(':studentnumber', $this->studentnumber);
        $query->bindValue(':name', $this->name);
        $query->execute();
        $row = $query->fetch();
    }
    
    public function validate_studentnumber() {
        $errors = array();
        if ($this->studentnumber == '') {
            $errors[] = 'Anna opiskelijanumero';
        }
        return $errors;
    }
    
    public function validate_authentity() {
        $errors = array();
        if ($this->studentnumber != '') {
            if (Student::findId($this->studentnumber) != NULL && Student::findId($this->studentnumber)->name != $this->name) {
                $errors[] = 'Tarkista nimi ja opiskelijanumero.';
            }
        }
        return $errors;
    }
    
    public function validate_name() {
        $errors = array();
        if ($this->name == '') {
            $errors[] = 'Anna opiskelijan nimi';
        }
        return $errors;
    }

}
