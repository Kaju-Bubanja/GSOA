DELIMITER $$

CREATE PROCEDURE export_insert(IN Land VARCHAR(40),
IN Art VARCHAR(40), IN System VARCHAR(40), IN Kategorie VARCHAR(40),
IN Year YEAR, IN Betrag INT) MODIFIES SQL DATA
BEGIN
	DECLARE Code_lookup CHAR(2) DEFAULT "CH";
	SELECT Code INTO Code_lookup FROM laender WHERE laender.Land=Land;
	INSERT INTO export (Code, Art, System, Kategorie, Year, Betrag) VALUES(Code_lookup, Art, System, Kategorie, Year, Betrag);
END$$
