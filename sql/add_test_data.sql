-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Kurssi (nimi) VALUES ('Ohjelmoinnin harjoitustyö');

INSERT INTO Opettaja (nimi) VALUES ('Matti Meikäläinen');

INSERT INTO Opiskelija (opiskelijanumero, nimi) VALUES (0123456789, 'Marko Vainio');

INSERT INTO Aihe (nimi, vaikeusaste, maksimiarvosana, kuvaus) VALUES 
            ('Miinaharava', 'Helppo', 5, 'Perinteinen miinaharava- peli');

INSERT INTO Harjoitustyö (alkamispvm, päättymispvm, arvosana) VALUES 
            ('2016-01-01', '2016-03-04', 5)
