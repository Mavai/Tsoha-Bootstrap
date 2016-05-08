-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Course (name) VALUES ('Ohjelmoinnin harjoitustyö');

INSERT INTO Course (name) VALUES ('Tietokantasovellus');

INSERT INTO Course (name) VALUES ('Tietorakenteet ja algoritmit');

INSERT INTO Teacher (name, password, rights) VALUES ('Normi', 'aaaaa', 'Normaali');

INSERT INTO Teacher (name, password, rights) VALUES ('Matti Meikäläinen', 'aaaaa', 'Ohjaaja');

INSERT INTO Teacher (name, password, rights) VALUES ('Mavai', 'aaaaa', 'Admin');

INSERT INTO Student (studentnumber, name) VALUES ('0123456789', 'Marko Vainio');

INSERT INTO Student (studentnumber, name) VALUES ('0123456779', 'Esimerkki Henkilö');

INSERT INTO Student (studentnumber, name) VALUES ('0123456769', 'Esimerkki Henkilö');

INSERT INTO Student (studentnumber, name) VALUES ('0123456759', 'Esimerkki Henkilö');

INSERT INTO Student (studentnumber, name) VALUES ('0123456749', 'Esimerkki Henkilö');

INSERT INTO Student (studentnumber, name) VALUES ('0123456739', 'Esimerkki Henkilö');

INSERT INTO Student (studentnumber, name) VALUES ('0123456729', 'Esimerkki Henkilö');

INSERT INTO Student (studentnumber, name) VALUES ('0123456719', 'Esimerkki Henkilö');

INSERT INTO Student (studentnumber, name) VALUES ('0123456709', 'Esimerkki Henkilö');

INSERT INTO Student (studentnumber, name) VALUES ('0123456009', 'Esimerkki Henkilö');

INSERT INTO Subject (name, difficulty, maxgrade, description, added, course_id) VALUES 
            ('Miinaharava', 'Helppo', 5, 'Perinteinen miinaharava- peli', current_timestamp, 1);

INSERT INTO Subject (name, difficulty, maxgrade, description, added, course_id) VALUES 
            ('Työaihekanta', 'Keskitasoa', 5, 
'Tietojenkäsittelytieteen laitoksen kullakin laboratoriokurssilla tehdään yksi harjoitustyö. Tarjolla on joukko työaiheita, joilla on tunnusnumero, nimi ja kuvaus sekä mahdollisesti joitain luokittelutekijöitä. Moniin töihin liittyy valinnaisuutta sisällön suhteen.

Töistä halutaan seurata sitä, kuinka usein tietty työ ja sen vaihtoehdot on annettu tehtäväksi ja kuka tehtävän on antanut. Samoin pidetään kirjaa siitä kauanko työhön on kulunut aikaa ja mikä arvosana työstä on annettu.

Opiskelijat voivat ennakkoon tutustua töihin www-sivun kautta ja hakea niitä luokittelutekijöiden avulla. Opiskelijat saavat näkyviinsä myös yhteenvedon työn suoritustiedoista (monestiko tehty, kauanko keskimäärin kestänyt, monestiko keskeytetty, mikä on ollut keskimääräinen arvosana). Opettajien pitäisi pystyä kirjaamaan uusia työaiheita ja kirjaamaan työhön liittyviä suoritustietoja. Opettajat näkevät myös opiskelijoita yksityiskohtaisemmin työhön liittyvät suoritustiedot. Laboratorion esihenkilö saa lisäksi yhteenvetotietoja töiden käytöstä.

Toimintoja:

- työaiheiden haku ja katselu
- opettajan kirjautuminen
- työaiheiden kirjaus, muokkaus ja poisto (tai käytöstä poistaminen)
- suoritustietojen kirjaus ja muokkaus
- opettajien yhteenvedot
- ylläpito voi lisätä ja muokata opettajien ja opiskelijoiden tietoja'
, current_timestamp, 2);

INSERT INTO Subject (name, difficulty, maxgrade, description, added, course_id) VALUES
            ('Vedonlyönti', 'Vaikea', 5,
'Potti Oy haluaa järjestää vedonvälitystä Internetissä. Rekisteröityneelle asiakkaalle toimitetaan kerran vuodessa salasanaluettelo kertakäyttöisistä salasanoista. Aina kun asiakas haluaa löydä vetoa hän kuluttaa yhden salasanan luettelostaan. Asiakkaalle perustetaan tili ja hän voi normaalina pankkisiirtona sijoittaa tililleen rahaa. Asiakas ei voi ylittää tilinsä saldoa. Asiakas voi lyödä vetoa erilaisista tilaisuuksista. Vedonlyöntiä ei voi perua. Voittajavedossa lyödään vetoa ottelun tai kisan voittajasta. Tulosvedossa lyödään vetoa ottelun lopputuloksesta. Tapahtumavedossa lyödään vetoa siitä toteutuuko tietty tapahtuma määriteltynä aikana. Kilpailuja on eri tyyppisiä urheilukilpailuista missikisoihin ja erilaisiin vaaleihin, mitä tahansa, missä on olemassa selkeä yksiselitteinen lopputulos. Potti Oy toimii vain vetojen välittäjänä ja ottaa tästä toiminnasta 20% välityspalkkion. Koko pelisummasta maksetaan arpajaisveroa 30 %. Jäljellejäävä osuus kuhunkin kisaan liittyvästä vedonlyöntipanoksesta jaetaan voittajille hyvittämällä summa heidän pankkitileilleen (ei siis pelitilille). Pelaajille näytetään koko ajan, mikä on sen hetkinen jaettava potti ja mitkä ovat eri vaihtoehtojen kertoimet. Jos mahdollista pelaajalle näytetään myös tietoja kisan osapuolten aiemmista sijoituksista. Asiakas voi tarjota kohteita vedonlyöntiin. Kohde laitetaan ehdokaskohteeksi ja tiedustellaan olisiko muilla asiakkailla kiinnostusta lyödä vetoa asiasta. Jos kiinnostusta ilmenee, kohde avataan vedonlyöntiin.

Toimintoja:

- Asiakkaaksi rekisteröityminen ja kirjautuminen
- Uuden salasanalistan pyyntö
- Vedon asetus ja sen kuittaus
- Vedonlyöntikohteen valinta
- Vedonlyöntikohteen esittely
- Tilastoja
- Vedonlyöntikohteen tarjoaminen
- Ylläpidon kirjautuminen
- Ehdokaskohteen kommentointi
- Kohteen avaus ja kohdetietojen kirjaus
- Kertoimien määritteleminen (voi olla automaattinen)

Sovelluksessa voidaan rajoittua vain tietyntyyppisiin vetoihin.',
current_timestamp, 2);

INSERT INTO Subject (name, difficulty, maxgrade, description, added, course_id) VALUES
            ('Ostoskassi', 'Keskitasoa', 5, 
'SiipiLomat Oy tarjoaa lentomatkustajille palvelua, jossa matkustajat voivat tilata tax free -ostoksia ennalta. Ostokset toimitetaan lentokoneeseen matkustajalle varatulle paikalle. Matkustaja voi tilata ostoksia sekä meno- että paluulennolle. Matkustaja voi saman käyttöliittymään kautta esittää myös erityistoiveita mm. lennolla tarjottavien aterioiden suhteen. Tax free -tuotteet jakautuvat muutamaan tuoteryhmään. Tuotteista näytetään asiakkaalle esittelymateriaalia.

järjestelmässä on myös syöttöosa, jolla tarjontatiedot saadaan syötettyä ja jolla niitä voidaan ylläpitää.

Tiedot paikkavarauksista saadaan ulkopuoliselta paikanvarausjärjestelmältä (eli ne ovat valmiina tietokannassa)

Toimintoja:

- Kirjautuminen
- Tilauksen laatiminen
- Tilauksen muuttaminen
- Tilauksen peruutus
- Lentokohtaiset tilausraportit toimitusta varten
- Toimitusasiakirja ja lasku
- Tuotetietojen lisäys, muokkas ja poisto',
current_timestamp, 2);

INSERT INTO Subject (name, difficulty, maxgrade, description, added, course_id) VALUES 
            ('Shakki', 'Haastava', 5, 'Tekoäly shakkipeliin', current_timestamp, 3);

INSERT INTO Subject (name, difficulty, maxgrade, description, added, course_id) VALUES 
            ('Shakki', 'Haastava', 5, 'Tekoäly shakkipeliin', current_timestamp, 1);

INSERT INTO Subject (name, difficulty, maxgrade, description, added, course_id) VALUES 
            ('Shakki', 'Haastava', 5, 'Tekoäly shakkipeliin', current_timestamp, 1);

INSERT INTO Assignment (begindate, enddate, status, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_timestamp, 'Kesken', 1, '0123456789', 2);

INSERT INTO Assignment (begindate, enddate, status, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_timestamp, 'Kesken', 1, '0123456779', 2);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_timestamp, 'Valmis', 5, 1, '0123456769', 2);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_timestamp, 'Valmis', 4, 1, '0123456759', 2);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_timestamp, 'Valmis', 3, 1, '0123456749', 2);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_timestamp, 'Valmis', 2, 1, '0123456739', 2);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_timestamp, 'Valmis', 0, 1, '0123456729', 2);

INSERT INTO Assignment (begindate, enddate, status, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_timestamp, 'Keskeytetty', 1, '0123456719', 2);

INSERT INTO Assignment (begindate, enddate, status, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_timestamp, 'Keskeytetty', 1, '0123456709', 2);

INSERT INTO Assignment (begindate, enddate, status, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_timestamp, 'Keskeytetty', 1, '0123456009', 2);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_timestamp, 'Valmis', 5, 1, '0123456789', 1);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_timestamp, 'Valmis', 4, 1, '0123456789', 3);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_timestamp, 'Valmis', 5, 1, '0123456789', 4);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_timestamp, 'Valmis', 5, 1, '0123456789', 6);

INSERT INTO Assignment (begindate, enddate, status, grade, teacher_id, student_id, subject_id) VALUES 
            (current_date, current_timestamp, 'Valmis', 5, 1, '0123456789', 6);