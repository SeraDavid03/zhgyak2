DROP SCHEMA IF EXISTS adatbazis;
CREATE SCHEMA adatbazis DEFAULT CHARACTER SET
utf8 COLLATE utf8_unicode_ci;
USE adatbazis;

CREATE TABLE hir (
	id INT PRIMARY KEY AUTO_INCREMENT,
	cim VARCHAR(255),
    megjdatum DATE,
    szoveg VARCHAR(255)
);

CREATE TABLE hozzaszolas (
	id INT PRIMARY KEY AUTO_INCREMENT,
	szerzo VARCHAR(255),
	hozzszoveg VARCHAR(255),
    hirid INT,
    CONSTRAINT FK_hozzaszolas_hir FOREIGN KEY (hirid)
    REFERENCES hir(id)
);

INSERT INTO hir(cim, megjdatum, szoveg) 
VALUES ('a','2020-10-10','asd');
INSERT INTO hir(cim, megjdatum, szoveg) 
VALUES ('b','2020-01-01','dsa');
INSERT INTO hozzaszolas(szerzo, hozzszoveg, hirid) 
VALUES ('Ádám','asdasdasdasd',1);
INSERT INTO hozzaszolas(szerzo, hozzszoveg, hirid) 
VALUES ('Béla','dsadsawdwasdaw',1);
INSERT INTO hozzaszolas(szerzo, hozzszoveg, hirid) 
VALUES ('Tamás','dwadswadsawd',2);

INSERT INTO hir(cim, megjdatum, szoveg) 
VALUES ('b','2025-01-01','dsa');
INSERT INTO hir(cim, megjdatum, szoveg) 
VALUES ('b','2026-01-01','dsa');
SELECT*FROM hir;

