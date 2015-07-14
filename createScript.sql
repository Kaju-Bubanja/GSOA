DROP TABLE IF EXISTS export;
DROP TABLE IF EXISTS laender;
CREATE TABLE laender (Code CHAR(2), Kontinent VARCHAR(12), Land VARCHAR(40), LandFranz VARCHAR(40),
INDEX(Code));
# Index is necessary when a column is used as foreign key - at least in older versions of mysql.

LOAD DATA LOCAL INFILE 'laender.csv' INTO TABLE laender CHARACTER SET utf8 COLUMNS TERMINATED BY ';';

ALTER TABLE laender ADD latitude FLOAT(10,6);
ALTER TABLE laender ADD longitude FLOAT(10,6);

CREATE TABLE export (Id INT NOT NULL AUTO_INCREMENT, Code CHAR(2), Art VARCHAR(40), System VARCHAR(10), Kategorie VARCHAR(15), Year Year, Betrag INT, PRIMARY KEY(Id), 
FOREIGN KEY (Code) REFERENCES laender(Code));
