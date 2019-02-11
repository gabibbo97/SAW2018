CREATE TABLE utente (
    username VARCHAR(20) PRIMARY KEY,
    nome VARCHAR(20) NOT NULL,
    cognome VARCHAR(20) NOT NULL,
    email TINYTEXT NOT NULL,
    password TINYTEXT NOT NULL,
    percorsoImmagine VARCHAR(20) NULL,
    riceveNewsletter BOOLEAN NOT NULL,
    tipoUtente ENUM('USER', 'ADMIN') NOT NULL,
    -- If a DEFAULT clause is missing, the default value will be the first value in the enumaration
    regione ENUM(
        'Abruzzo',
        'Basilicata',
        'Calabria',
        'Campania',
        'EmiliaRomagna',
        'FriuliVeneziaGiulia',
        'Lazio',
        'Liguria',
        'Lombardia',
        'Marche',
        'Molisa',
        'Piemonte',
        'Puglia',
        'Sardegna',
        'Sicilia',
        'Toscana',
        'TrentinoAltoAdige',
        'Umbria',
        'ValleDAosta',
        'Veneto'
    ) NULL
);
