-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Course (name) VALUES ('Ohjelmoinnin harjoitustyö');

INSERT INTO Course (name) VALUES ('Tietokantasovellus');

INSERT INTO Course (name) VALUES ('Tietorakenteet ja algoritmit');

INSERT INTO Teacher (name, password) VALUES ('Matti Meikäläinen', 'aaaaa');

INSERT INTO Student (studentnumber, name) VALUES (0123456789, 'Marko Vainio');

INSERT INTO Subject (name, difficulty, maxgrade, description, added, course_id) VALUES 
            ('Miinaharava', 'Helppo', 5, 'Perinteinen miinaharava- peli', '1.1.2016', 1);

INSERT INTO Subject (name, difficulty, maxgrade, description, course_id) VALUES 
            ('Työaihekanta', 'Keskitasoa', 5, 'Harjoitustöiden aihekanta', 2);

INSERT INTO Subject (name, difficulty, maxgrade, description, course_id) VALUES 
            ('Shakki', 'Haastava', 5, 'Tekoäly shakkipeliin', 3);

INSERT INTO Assignment (begindate, enddate, grade) VALUES 
            ('2016-01-01', '2016-03-04', 5)
