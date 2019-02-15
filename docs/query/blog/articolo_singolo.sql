-- Restituisce
--   id e titolo articolo precedente (se presente)
--   id e titolo articolo successivo (se presente)
--   titolo, sottotitolo, data e corpo dell'articolo corrente
SELECT
    articoli_precedenti.id AS 'id_prec',
    articoli_precedenti.titolo AS 'titolo_prec',
    articolo.titolo AS 'titolo',
    articolo.sottotitolo AS 'sottotitolo',
    articolo.corpo AS 'corpo',
    articolo.autore AS 'autore',
    articoli_successivi.id AS 'id_succ',
    articoli_successivi.titolo AS 'titolo_succ'
FROM                                                                                              -- Genera una tabella |PRECEDENTE|CORRENTE|SUCCESSIVO|
    articolo AS articoli_precedenti
    RIGHT OUTER JOIN articolo ON articoli_precedenti.id < articolo.id                             -- Ritorna NULL/Gli articoli con id < di articolo affiancata a sinistra di articolo
    LEFT OUTER JOIN articolo AS articoli_successivi ON articoli_successivi.id > articolo.id       -- Ritorna NULL/Gli articoli con id > di articolo affiancata a destra di articolo
WHERE
    articolo.id = :id                                                                             -- Verifica che l'ID dell'articolo corrente sia corretto
    AND (
        articoli_precedenti.id = (                                                                -- Il precedente é il post con ID massimo tra quelli con ID inferiore a quello dell'articolo
            SELECT
                Max(id)
            FROM
                articolo
            WHERE
                articolo.id < :id
        )
        OR articoli_precedenti.id IS NULL                                                         -- Altrimenti va bene un predecessore vuoto
    )
    AND (
        articoli_successivi.id = (                                                                -- Il successivo é il post con ID minimo tra quelli con ID superiore a quello dell'articolo
            SELECT
                Min(id)
            FROM
                articolo
            WHERE
                articolo.id > :id
        )
        OR articoli_successivi.id IS NULL                                                         -- Altrimenti va bene un successivo vuoto
    )