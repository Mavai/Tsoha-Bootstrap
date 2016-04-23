-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Course(
    id SERIAL PRIMARY KEY,
    name varchar(50)
);

CREATE TABLE Teacher(
    id SERIAL PRIMARY KEY,
    name varchar(50),
    password varchar(50)
);

CREATE TABLE Student(
    studentnumber NUMERIC PRIMARY KEY,
    name varchar(50)
);

CREATE TABLE Subject(
    id SERIAL PRIMARY KEY,
    name varchar(50),
    difficulty varchar(50),
    maxgrade INTEGER,
    description varchar(500),
    added DATE,
    course_id INTEGER REFERENCES Course(id)
);

CREATE TABLE Assignment(
    id SERIAL PRIMARY KEY,
    begindate DATE,
    enddate DATE,
    status varchar(20),
    grade INTEGER,
    teacher_id INTEGER REFERENCES Teacher(id),
    student_id INTEGER REFERENCES Student(studentnumber),
    subject_id INTEGER REFERENCES Subject(id)
);
