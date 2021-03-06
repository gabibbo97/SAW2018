CREATE TABLE IF NOT EXISTS utente (
    username VARCHAR(20) PRIMARY KEY,
    nome VARCHAR(20) NOT NULL,
    cognome VARCHAR(20) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password TINYTEXT NOT NULL,
    immagine LONGBLOB NULL,
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
        'Molise',
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
