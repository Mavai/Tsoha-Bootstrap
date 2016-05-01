<?php

class Assignment extends BaseModel {

    public $id, $begindate, $enddate, $status, $grade, $teacher, $student, $subject, $validators;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_status', 'validate_grade', 'validate_dates');
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
        $query = DB::connection()->prepare('SELECT *, to_char(begindate, \'DD.MM.YYYY\') AS begin, to_char(enddate, \'DD.MM.YYYY\') AS end 
                                            FROM Assignment  WHERE subject_id = :id ORDER BY Status DESC, Grade DESC');
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

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Assignment (begindate, enddate, status, grade, subject_id, student_id, teacher_id) '
                . 'VALUES (:begindate, :enddate, :status, :grade, :subject_id, :student_id, :teacher_id) RETURNING id');
        $query->bindValue(':begindate', $this->begindate);
        $query->bindValue(':enddate', $this->enddate);
        $query->bindValue(':status', $this->status);
        $query->bindValue(':grade', $this->grade);
        $query->bindValue(':subject_id', $this->subject->id);
        $query->bindValue(':student_id', $this->student);
        $query->bindValue(':teacher_id', $this->teacher->id);
        $query->execute();
        $row = $query->fetch();

        $this->id = $row['id'];
    }
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Assignment WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }
    
    public function validate_status() {
        $errors = array();
        if ($this->status == '' || $this->status == NULL) {
            $errors[] = 'Suorituksella on oltava jokin status';
        }
        return $errors;
    }
    
    public function validate_grade() {
        $errors = array();
        if ($this->status == 'Kesken' || $this->status == 'Keskeytetty') {
            if ($this->grade != NULL || $this->grade != '') {
                $errors[] = 'Keskeneräisellä tai keskeytetyllä suorituksella ei voi olla arvosanaa.';
            }
        }
        if ($this->status == 'Valmis' && $this->grade == '') {
            $errors[] = 'Anna suoritukselle arvosana.';
        }
        return $errors;
    }
    
    public function validate_dates() {
        $errors = array();
        if ($this->begindate == '') {
            $errors[] = 'Anna suorituksen alkamispäivä.';
        }
        if (($this->status == 'Valmis' || $this->status == 'Keskeytetty') && $this->enddate == '') {
            $errors[] = 'Anna suorituksen lopetupäivä.';
        }
        if ($this->enddate == '') {
            $this->enddate = NULL;
        }
        return $errors;
    }

}
