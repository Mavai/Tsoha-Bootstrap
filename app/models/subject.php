<?php

class Subject extends BaseModel {

    public $id, $name, $difficulty, $maxgrade, $description, $course_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function findAll() {
        $query = DB::connection()->prepare('SELECT * FROM Aihe');

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
        $query = DB::connection()->prepare('SELECT * FROM Aihe WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if ($row){
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

}

