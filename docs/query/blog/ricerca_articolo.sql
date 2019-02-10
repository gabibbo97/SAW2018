SELECT
    *,
    MATCH(corpo) AGAINST ('keyword1,keyword2,...') AS 'rilevanza'
FROM
    articolo
WHERE
    MATCH(corpo) AGAINST ('keyword1,keyword2,...');