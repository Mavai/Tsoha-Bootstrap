<?php

class Student extends BaseModel {

    public $studentnumber, $name;

    public function __construct($attributes) {
        parent::__construct($attributes);
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

}
