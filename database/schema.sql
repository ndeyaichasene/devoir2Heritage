-- Active: 1786959469190@@127.0.0.1@5432@heritage_devoir2
CREATE TABLE copies(
    id SERIAL PRIMARY KEY,
    dateDepot TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    noteBrute NUMERIC(4,2) NOT NULL,
    noteFinale NUMERIC(4,2) NOT NULL,
    penaliteAppliquee BOOLEAN NOT NULL,
    dateLimite TIMESTAMP NOT NULL
);

INSERT INTO copies (dateDepot, noteBrute, noteFinale, penaliteAppliquee, dateLimite
)
VALUES (
    CURRENT_TIMESTAMP,
    16.50,
    14.50,
    TRUE,
    '2026-09-15 23:59:59'
);

INSERT INTO copies (
    noteBrute,
    noteFinale,
    penaliteAppliquee,
    dateLimite
)
VALUES (
    18.00,
    18.00,
    FALSE,
    '2026-09-15 23:59:59'
);

SELECT * FROM copies;