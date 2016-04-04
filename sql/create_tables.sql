-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kurssi(
    id SERIAL PRIMARY KEY,
    nimi varchar(50)
);

CREATE TABLE Opettaja(
    id SERIAL PRIMARY KEY,
    nimi varchar(50)
);

CREATE TABLE Opiskelija(
    opiskelijanumero NUMERIC PRIMARY KEY,
    nimi varchar(50)
);

CREATE TABLE Aihe(
    id SERIAL PRIMARY KEY,
    nimi varchar(50),
    vaikeusaste varchar(50),
    maksimiarvosana INTEGER,
    kuvaus varchar(500)
);

CREATE TABLE Harjoitustyö(
    id SERIAL PRIMARY KEY,
    alkamispvm DATE,
    päättymispvm DATE,
    arvosana INTEGER,
    kurssi INTEGER REFERENCES Kurssi(id),
    opettaja INTEGER REFERENCES Opettaja(id),
    opiskelija INTEGER REFERENCES Opiskelija(opiskelijanumero),
    aihe INTEGER REFERENCES Aihe(id)
);
