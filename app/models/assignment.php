<?php

class Assignment extends BaseModel {

    public $id, $begindate, $enddate, $status, $grade, $teacher, $student, $subject;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function findAll() {
        $query = DB::connection()->prepare('SELECT * FROM Assignment');

        $query->execute();

        $rows = $query->fetchAll();
        $courses = array();

        foreach ($rows as $row) {
            $courses[] = new Assignment(array(
                'id' => $row['id'],
                'begindate' => $row['begindate'],
                'enddate' => $row['enddate'],
                'status' => $row['status'],
                'grade' => $row['grade'],
                'teacher' => User::findId($row['teacher_id']),
                'student' => Student::findId($row['student_id']),
                'subject' => Subject::findId($row['subject_id'])
            ));
        }
        return $courses;
    }

    public static function findId($id) {
        $query = DB::connection()->prepare('SELECT *, to_char(begindate, \'DD.MM.YYYY\') AS begin, to_char(enddate, \'DD.MM.YYYY\') AS end FROM Assignment WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $assignment = new Assignment(array(
                'id' => $row['id'],
                'begindate' => $row['begin'],
                'enddate' => $row['end'],
                'status' => $row['status'],
                'grade' => $row['grade'],
                'teacher' => User::findId($row['teacher_id']),
                'student' => Student::findId($row['student_id']),
                'subject' => Subject::findId($row['subject_id'])
            ));
            return $assignment;
        }
        return null;
    }
    
        public static function findAllIn($subjectId) {
        $query = DB::connection()->prepare('SELECT *, to_char(begindate, \'DD.MM.YYYY\') AS begin, to_char(enddate, \'DD.MM.YYYY\') AS end FROM Assignment  WHERE subject_id = :id');
        $query->execute(array('id' => $subjectId));
        $rows = $query->fetchAll();
        
        $assignments = array();
        
        foreach ($rows as $row) {
            $assignments[] = new Assignment(array(
                'id' => $row['id'],
                'begindate' => $row['begin'],
                'enddate' => $row['end'],
                'status' => $row['status'],
                'grade' => $row['grade'],
                'teacher' => User::findId($row['teacher_id']),
                'student' => Student::findId($row['student_id']),
                'subject' => Subject::findId($row['subject_id'])
            ));
        }
        return $assignments;
    }

}
