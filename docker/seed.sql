CREATE TABLE IF NOT EXISTS cities (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO cities (name) VALUES
('Riga'),
('Vilnius'),
('Tallinn'),
('Helsinki'),
('Stockholm'),
('Warsaw'),
('Berlin'),
('Paris'),
('London'),
('Rome'),
('New York');
