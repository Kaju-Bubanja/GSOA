DROP TABLE IF EXISTS export;
DROP TABLE IF EXISTS laender;
DROP TABLE IF EXISTS art;
DROP TABLE IF EXISTS system;
DROP TABLE IF EXISTS kategorie;

CREATE TABLE laender (Code CHAR(2), Kontinent VARCHAR(12), Land VARCHAR(40), LandFranz VARCHAR(40),
INDEX(Code));
# Index is necessary when a column is used as foreign key - at least in older versions of mysql.

LOAD DATA LOCAL INFILE 'laender.csv' INTO TABLE laender CHARACTER SET utf8 COLUMNS TERMINATED BY ';';

ALTER TABLE laender ADD latitude FLOAT(10,6);
ALTER TABLE laender ADD longitude FLOAT(10,6);

INSERT INTO laender (Code, Kontinent, Land, LandFranz, latitude, longitude) VALUES ("HU", "Europa", "Ungarn", "Hongrie", 47.503672, 19.033590);
INSERT INTO laender (Code, Kontinent, Land, LandFranz, latitude, longitude) VALUES ("BJ", "Afrika", "Benin", "Bénin", 6.502603, 2.611570);
INSERT INTO laender (Code, Kontinent, Land, LandFranz, latitude, longitude) VALUES ("GW", "Afrika", "Guinea-Bissau", "Guinée Bissau", 11.871668, -15.624172);
INSERT INTO laender (Code, Kontinent, Land, LandFranz, latitude, longitude) VALUES ("NA", "Afrika", "Namibia", "Namibie", -22.561842, 17.064777);

CREATE TABLE art (
  Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  Art VARCHAR(40),
  INDEX(Art)
);

CREATE TABLE system (
  Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  System VARCHAR(40),
  INDEX(System)
);

CREATE TABLE kategorie (
  Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  Kategorie VARCHAR(40),
  INDEX(kategorie)
);

INSERT INTO art (Art) VALUES ("Kriegsmaterial");
INSERT INTO art (Art) VALUES ("Besondere Militärische Güter");
INSERT INTO art (Art) VALUES ("Dual Use Güter");

CREATE TABLE export (
  Id INT NOT NULL AUTO_INCREMENT, 
  Code CHAR(2), 
  Art VARCHAR(40), 
  System VARCHAR(10), 
  Kategorie VARCHAR(15), 
  Year Year, 
  Betrag INT, 
  PRIMARY KEY(Id), 
  FOREIGN KEY (Code) REFERENCES laender(Code), 
  FOREIGN KEY (Art) REFERENCES art(Art), 
  FOREIGN KEY (System) REFERENCES system(System),
  FOREIGN KEY (Kategorie) REFERENCES kategorie(Kategorie)
);



