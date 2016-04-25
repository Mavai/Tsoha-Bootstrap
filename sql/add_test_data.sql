-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Course (name) VALUES ('Ohjelmoinnin harjoitustyö');

INSERT INTO Course (name) VALUES ('Tietokantasovellus');

INSERT INTO Course (name) VALUES ('Tietorakenteet ja algoritmit');

INSERT INTO Teacher (name, password) VALUES ('Matti Meikäläinen', 'aaaaa');

INSERT INTO Teacher (name, password) VALUES ('Testi', 'aaaaa');

INSERT INTO Student (studentnumber, name) VALUES (0123456789, 'Testi Henkilö');

INSERT INTO Subject (name, difficulty, maxgrade, description, added, course_id) VALUES 
            ('Miinaharava', 'Helppo', 5, 'Perinteinen miinaharava- peli', current_date, 1);

INSERT INTO Subject (name, difficulty, maxgrade, description, added, course_id) VALUES 
            ('Työaihekanta', 'Keskitasoa', 5, 'Harjoitustöiden aihekanta', current_date, 2);

INSERT INTO Subject (name, difficulty, maxgrade, description, added, course_id) VALUES 
            ('Shakki', 'Haastava', 5, 'Tekoäly shakkipeliin', current_date, 3);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'kesken', 5, 1, 0123456789, 1);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'kesken', 5, 1, 0123456789, 1);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'kesken', 5, 1, 0123456789, 1);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'kesken', 5, 1, 0123456789, 1);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'kesken', 5, 1, 0123456789, 1);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'kesken', 5, 1, 0123456789, 1);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'kesken', 5, 1, 0123456789, 1);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'kesken', 5, 1, 0123456789, 1);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'kesken', 5, 1, 0123456789, 1);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_date, 'kesken', 5, 1, 0123456789, 1);
