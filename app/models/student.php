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
    
    public static function info($studentnumber) {
        $query = DB::connection()->prepare('SELECT COUNT(studentnumber) AS count FROM Student, Assignment WHERE studentnumber = :studentnumber '
                . 'AND Assignment.student_id = studentnumber');
        $query->execute(array(':studentnumber' => $studentnumber));
        $row = $query->fetch();
        return $row['count'];
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Student (studentnumber, name) VALUES (:studentnumber, :name)');
        $query->bindValue(':studentnumber', $this->studentnumber);
        $query->bindValue(':name', $this->name);
        $query->execute();
        $row = $query->fetch();
    }
    
    public function update($old) {
        $query = DB::connection()->prepare('UPDATE Student SET name = :name, studentnumber = :new WHERE studentnumber = :studentnumber');
        $query->bindValue(':name', $this->name);
        $query->bindValue(':new', $this->studentnumber);
        $query->bindValue(':studentnumber', $old);
        $query->execute();
    }
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Student WHERE studentnumber = :studentnumber');
        $query->execute(array(':studentnumber' => $this->studentnumber));
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
