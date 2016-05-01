-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Course (name) VALUES ('Ohjelmoinnin harjoitustyö');

INSERT INTO Course (name) VALUES ('Tietokantasovellus');

INSERT INTO Course (name) VALUES ('Tietorakenteet ja algoritmit');

INSERT INTO Teacher (name, password) VALUES ('Matti Meikäläinen', 'aaaaa');

INSERT INTO Teacher (name, password) VALUES ('Testi', 'aaaaa');

INSERT INTO Student (studentnumber, name) VALUES (0123456789, 'Testi Henkilö');

INSERT INTO Student (studentnumber, name) VALUES (0123456779, 'Testi Henkilö');

INSERT INTO Student (studentnumber, name) VALUES (0123456769, 'Testi Henkilö');

INSERT INTO Student (studentnumber, name) VALUES (0123456759, 'Testi Henkilö');

INSERT INTO Student (studentnumber, name) VALUES (0123456749, 'Testi Henkilö');

INSERT INTO Student (studentnumber, name) VALUES (0123456739, 'Testi Henkilö');

INSERT INTO Student (studentnumber, name) VALUES (0123456729, 'Testi Henkilö');

INSERT INTO Student (studentnumber, name) VALUES (0123456719, 'Testi Henkilö');

INSERT INTO Student (studentnumber, name) VALUES (0123456709, 'Testi Henkilö');

INSERT INTO Student (studentnumber, name) VALUES (0123456009, 'Testi Henkilö');

INSERT INTO Subject (name, difficulty, maxgrade, description, added, course_id) VALUES 
            ('Miinaharava', 'Helppo', 5, 'Perinteinen miinaharava- peli', current_date, 1);

INSERT INTO Subject (name, difficulty, maxgrade, description, added, course_id) VALUES 
            ('Työaihekanta', 'Keskitasoa', 5, 'Harjoitustöiden aihekanta', current_date, 2);

INSERT INTO Subject (name, difficulty, maxgrade, description, added, course_id) VALUES 
            ('Shakki', 'Haastava', 5, 'Tekoäly shakkipeliin', current_date, 3);

INSERT INTO Assignment (begindate, enddate, status, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'Kesken', 1, 0123456789, 1);

INSERT INTO Assignment (begindate, enddate, status, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'Kesken', 1, 0123456779, 1);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'Valmis', 5, 1, 0123456769, 1);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'Valmis', 4, 1, 0123456759, 1);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'Valmis', 3, 1, 0123456749, 1);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'Valmis', 2, 1, 0123456739, 1);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'Valmis', 0, 1, 0123456729, 1);

INSERT INTO Assignment (begindate, enddate, status, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'Keskeytetty', 1, 0123456719, 1);

INSERT INTO Assignment (begindate, enddate, status, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'Keskeytetty', 1, 0123456709, 1);

INSERT INTO Assignment (begindate, enddate, status, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'Keskeytetty', 1, 0123456009, 1);
