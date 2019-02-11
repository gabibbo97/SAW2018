CREATE TABLE caratterizza (
    id_articolo BIGINT UNSIGNED,
    tag VARCHAR(20),
    PRIMARY KEY(id_articolo, tag),
    FOREIGN KEY (tag) REFERENCES tag (nome) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_articolo) REFERENCES articolo (id) ON DELETE CASCADE ON UPDATE CASCADE
);