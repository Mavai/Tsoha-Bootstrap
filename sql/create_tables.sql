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
    studentnumber varchar(10) PRIMARY KEY,
    name varchar(50)
);

CREATE TABLE Subject(
    id SERIAL PRIMARY KEY,
    name varchar(50),
    difficulty varchar(50),
    maxgrade INTEGER,
    description varchar(5000),
    added TIMESTAMP,
    course_id INTEGER REFERENCES Course(id) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE Assignment(
    id SERIAL PRIMARY KEY,
    begindate DATE,
    enddate DATE,
    status varchar(20),
    grade INTEGER,
    teacher_id INTEGER REFERENCES Teacher(id) ON DELETE SET NULL ON UPDATE CASCADE,
    student_id varchar(10) REFERENCES Student(studentnumber) ON DELETE CASCADE ON UPDATE CASCADE,
    subject_id INTEGER REFERENCES Subject(id) ON DELETE CASCADE ON UPDATE CASCADE
);
