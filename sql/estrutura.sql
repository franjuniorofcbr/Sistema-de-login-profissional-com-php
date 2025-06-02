CREATE DATABASE login_mvc;
USE login_mvc;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);

INSERT INTO users (name, email, password)
VALUES ('Admin', 'admin@example.com', PASSWORD_HASH('123456', PASSWORD_DEFAULT));
