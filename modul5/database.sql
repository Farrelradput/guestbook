CREATE DATABASE guestbook_db;
USE guestbook_db;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

CREATE TABLE guestbook (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    timestamp DATETIME NOT NULL
);

-- Tambahkan user
INSERT INTO users (username, password) VALUES ('admin', 'admin123');
INSERT INTO users (username, password) VALUES ('farrel', '123');

