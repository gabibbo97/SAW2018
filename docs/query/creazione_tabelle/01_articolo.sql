CREATE TABLE articolo (
    id SERIAL PRIMARY KEY,
    titolo VARCHAR(100) NOT NULL,
    sottotitolo VARCHAR(200) NULL,
    data DATE NOT NULL DEFAULT (CURRENT_DATE()),
    corpo MEDIUMTEXT NOT NULL,
    autore VARCHAR(20) NOT NULL,
    FOREIGN KEY (autore) REFERENCES utente (username) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE FULLTEXT INDEX testo_articoli ON articolo(corpo);
