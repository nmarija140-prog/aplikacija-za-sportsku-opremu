
use sportska_oprema;

create table KORISNICI(id int auto_increment primary key, 
ime varchar(50) not null, prezime varchar(50) not null, email 
varchar(50) not null unique, lozinka varchar(50) not null, uloga enum('nastavnik', 'admin') default 'nastavnik',
 datum_registracije datetime default current_timestamp);
 
 create table NASTAVNICI ( id int auto_increment primary key, ime varchar (50) not null, prezime varchar(50) not null, email varchar(50) 
 not null unique, telefon varchar(20) not null, predmet varchar(100));
 
 create table PROSTORIJE (id int auto_increment primary key, naziv varchar(50) not null, kapacitet int, lokacija varchar(100));
 
 create table OPREMA (id int auto_increment key, naziv varchar(100) not null, tip varchar(50), kolicina int default 1, stanje enum ('ispravna',
 'oštećena', 'na_prepravci') default 'ispravna', prostorija_id int, datum_nabavke date, foreign key (prostorija_id) references PROSTORIJE(id));
 
 create table ZADUZENJA (id int auto_increment primary key, oprema_id int not null, nastavnik_id int not null, datum_zaduzenja date not null, datum_vracanja date,
 napomena text, foreign key (oprema_id) references OPREMA (id), foreign key (nastavnik_id) references NASTAVNICI(id));
 
 create table ODRZAVANJE (id int auto_increment primary key, oprema_id int not null, datum_prepravke date not null, opis_rada text, troskovi
 decimal (10,2), serviser varchar (100), foreign key (oprema_id)references OPREMA(id));
 
 INSERT INTO NASTAVNICI (ime, prezime, email, telefon, predmet) VALUES
('Marko', 'Petrović', 'marko@skola.rs', '0642670370', 'Fizičko vaspitanje'),
('Ana', 'Jovanović', 'ana@skola.rs', '0653817700', 'Fizičko vaspitanje'),
('Miloš', 'Nikolić', 'stefan@skola.rs', '0663817707', 'Biologija');

INSERT INTO PROSTORIJE (naziv, kapacitet, lokacija) VALUES
('Fiskulturna sala', 50, 'Prizemlje'),
('Sportski teren', 20, 'Školsko dvorište'),
('Skladište opreme', null, 'Prizemlje');

INSERT INTO OPREMA (naziv, tip, kolicina, stanje, prostorija_id, datum_nabavke) VALUES
('Košarkaška lopta', 'Lopta', 10, 'ispravna', 1, '2022-01-15'),
('Fudbalska lopta', 'Lopta', 8, 'ispravna', 1, '2022-02-10'),
('Strunjača', 'Rekvizit', 15, 'ispravna', 2, '2022-09-01'),
('Koš za košarku', 'Pomoćna oprema', 2, 'oštećena', 1, '2022-05-20'),
('Mreža za odbojku', 'Pomoćna oprema', 1, 'na_prepravci', 1, '2022-03-12');

INSERT INTO ZADUZENJA (oprema_id, nastavnik_id, datum_zaduzenja, napomena) VALUES
(1, 1, '2026-06-01', 'Zaduženo za turnir'),
(3, 2, '2026-05-20', 'Redovna upotreba');

INSERT INTO ODRZAVANJE (oprema_id, datum_servisa, opis_rada, troskovi, serviser) VALUES
(4, '2026-05-15', 'Popravka koša', 2500.00, 'Servis d.o.o.'),
(5, '2026-06-01', 'Zamena mreže', 1800.00, 'Sport servis');



 
 
 
 
