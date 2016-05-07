<?php

class Subject extends BaseModel {

    public $id, $name, $difficulty, $maxgrade, $description, $course, $added, $validators;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_maxgrade');
    }

    public static function findAll() {
        $query = DB::connection()->prepare('SELECT *, to_char(added, \'DD.MM.YYYY\') FROM Subject ORDER BY added');

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
                'added' => $row['to_char'],
                'course' => Course::findId($row['course_id'])
            ));
        }
        return $subjects;
    }

    public static function findId($id) {
        $query = DB::connection()->prepare('SELECT *, to_char(added, \'DD.MM.YYYY\') FROM Subject WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $subject = new Subject(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'difficulty' => $row['difficulty'],
                'maxgrade' => $row['maxgrade'],
                'description' => $row['description'],
                'added' => $row['to_char'],
                'course' => Course::findId($row['course_id'])
            ));
            return $subject;
        }
        return null;
    }

    public static function findAllIn($courseId) {
        $query = DB::connection()->prepare('SELECT *, to_char(added, \'DD.MM.YYYY\') FROM Subject  WHERE course_id = :id ORDER BY Added');
        $query->execute(array('id' => $courseId));
        $rows = $query->fetchAll();
        $query = DB::connection()->prepare('SELECT AVG(Assignment.grade) FROM Subject, Assignment WHERE course_id = :id AND subject.id = assignment.subject_id');
        $query->execute(array('id' => $courseId));
        $avg = $query->fetchAll();

        $subjects = array();

        foreach ($rows as $row) {
            $subjects[] = new Subject(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'difficulty' => $row['difficulty'],
                'maxgrade' => $row['maxgrade'],
                'description' => $row['description'],
                'added' => $row['to_char'],
                'course' => Course::findId($row['course_id']),
            ));
        }
        return $subjects;
    }

    public static function avgGradeIn($subjectId) {
        $query = DB::connection()->prepare('SELECT ROUND(AVG(Assignment.grade), 1) AS averagegrade FROM Subject, Assignment WHERE subject_id = :id AND subject.id = assignment.subject_id');
        $query->execute(array('id' => $subjectId));
        $rows = $query->fetchAll();
        $avg = $rows[0];
        return $avg['averagegrade'];
    }

    public static function completionInfo($subjectId) {
        $query = DB::connection()->prepare('SELECT (SELECT COUNT(Assignment.id) FROM Subject, Assignment WHERE Subject.id = Assignment.subject_id
                                            AND Subject.id = :id) AS all, 
                                            (SELECT COUNT(Assignment.id) FROM Subject, Assignment WHERE Subject.id = Assignment.subject_id
                                            AND Subject.id = :id AND Assignment.status = \'Valmis\') AS completed, 
                                            (SELECT COUNT(Assignment.id) FROM Subject, Assignment WHERE subject.id = Assignment.subject_id
                                            AND subject.id = :id AND (assignment.status = \'Valmis\' OR assignment.status = \'Keskeytetty\')) AS finished,
                                            (SELECT COUNT(Assignment.id) FROM Subject, Assignment WHERE Subject.id = Assignment.subject_id 
                                            AND Subject.id = :id AND Assignment.status = \'Keskeytetty\') AS aborted,
                                            (SELECT to_char(Added, \'DD.MM.YYYY\') FROM Assignment, Subject WHERE Subject.id = Assignment.subject_id 
                                            AND Subject.id = :id ORDER BY Added LIMIT 1) AS latest');
        $query->execute(array(':id' => $subjectId));
        $rows = $query->fetchAll();
        $row = $rows[0];
        if ($row['finished'] != 0) {
            $completionInfo = array('all' => $row['all'], 'completionrate' => round($row['completed'] / $row['finished'], 3), 'aborted' => $row['aborted'],
                                    'latest' => $row['latest']);
        } else {
            $completionInfo = array('all' => $row['all'], 'completionrate' => 0, 'aborted' => $row['aborted']);
        }
        return $completionInfo;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Subject (name, difficulty, maxgrade, description, course_id, added) '
                . 'VALUES (:name, :difficulty, :maxgrade, :description, :course_id, :added) RETURNING id');
        $query->execute(array(':name' => $this->name, ':difficulty' => $this->difficulty, ':maxgrade' => $this->maxgrade,
            ':description' => $this->description, ':course_id' => $this->course->id, ':added' => date('d.m.Y')));

        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Subject SET name = :name, difficulty = :difficulty, maxgrade = :maxgrade, description = :description WHERE id = :id2');
        $query->bindValue(':name', $this->name);
        $query->bindValue(':difficulty', $this->difficulty);
        $query->bindValue(':maxgrade', $this->maxgrade);
        $query->bindValue(':description', $this->description);
        $query->bindValue(':id2', $this->id);
        $query->execute();

        $row = $query->fetch();
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Subject WHERE id = :id');
        $query->execute(array('id' => $this->id));
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
