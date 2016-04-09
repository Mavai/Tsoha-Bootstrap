-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Course (name) VALUES ('Ohjelmoinnin harjoitustyö');

INSERT INTO Teacher (name) VALUES ('Matti Meikäläinen');

INSERT INTO Student (studentnumber, name) VALUES (0123456789, 'Marko Vainio');

INSERT INTO Subject (name, difficulty, maxgrade, description, course_id) VALUES 
            ('Miinaharava', 'Helppo', 5, 'Perinteinen miinaharava- peli', 1);

INSERT INTO Assignment (begindate, enddate, grade) VALUES 
            ('2016-01-01', '2016-03-04', 5)
