<?php

class User extends BaseModel {

    public $id, $name, $password, $rights, $validators;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_password', 'validate_name_length', 'validate_password_length');
    }

    public static function authenticate($name, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Teacher WHERE name = :name AND password = :password LIMIT 1');
        $query->execute(array('name' => $name, 'password' => $password));
        $row = $query->fetch();
        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
            return $user;
        }
        return null;
    }

    public static function findAll() {
        $query = DB::connection()->prepare('SELECT * FROM Teacher ORDER BY name');

        $query->execute();

        $rows = $query->fetchAll();
        $teachers = array();

        foreach ($rows as $row) {
            $teachers[] = new User(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
        }
        return $teachers;
    }

    public static function findId($id) {
        $query = DB::connection()->prepare('SELECT * FROM Teacher WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password'],
                'rights' => $row['rights']
            ));
            return $user;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Teacher (name, password, rights) VALUES (:name, :password, :rights) RETURNING id');
        $query->bindValue(':name', $this->name);
        $query->bindValue(':password', $this->password);
        $query->bindValue(':rights', $this->rights);
        $query->execute();
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function validate_name() {
        $errors = array();
        if ($this->name == '') {
            $errors[] = 'Anna nimi.';
        }
        return $errors;
    }

    public function validate_password() {
        $errors = array();
        if ($this->password == '') {
            $errors[] = 'Anna salasana';
        }
        return $errors;
    }
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Teacher SET name = :name, password = :password, rights = :rights WHERE id = :id');
        $query->bindValue(':name', $this->name);
        $query->bindValue(':password', $this->password);
        $query->bindValue(':id', $this->id);
        $query->bindValue(':rights', $this->rights);
        $query->execute();
    }
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Teacher WHERE id = :id');
        $query->execute(array(':id' => $this->id));
    }
    
    public function validate_password_length() {
        return parent::validate_string_length($this->password, 50, 'Salasana');
    }
    
    public function validate_name_length() {
        return parent::validate_string_length($this->name, 50, 'Nimi');
    }

}
