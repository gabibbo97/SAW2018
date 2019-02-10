SELECT
    DISTINCT titolo,
    sottotitolo,
    data
FROM
    articolo
    INNER JOIN caratterizza ON articolo.id = caratterizza.id_articolo
    INNER JOIN tag ON caratterizza.tag = tag.nome
WHERE
    tag.nome IN ('tag1', 'tag2')
ORDER BY
    articolo.id
LIMIT
    0, 5;