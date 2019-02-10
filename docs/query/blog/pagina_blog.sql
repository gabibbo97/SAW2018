SELECT
    titolo,
    sottotitolo,
    data
FROM
    articolo
ORDER BY
    articolo.id
LIMIT
    <OFFSET>, 5;