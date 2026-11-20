-- Пароли тестовых пользователей (в базе хранятся только хеш и соль):
--   student@example.com — student123
--   ivan@example.com    — ivan12345
--   olga@example.com    — olga12345
--   admin@example.com   — admin123

DROP DATABASE IF EXISTS library;
CREATE DATABASE library CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE library;

CREATE TABLE author (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    country VARCHAR(50) NOT NULL
);

CREATE TABLE genre (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE book (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    year SMALLINT NOT NULL,
    author_id INT NOT NULL,
    genre_id INT NOT NULL,
    FOREIGN KEY (author_id) REFERENCES author(id),
    FOREIGN KEY (genre_id) REFERENCES genre(id)
);

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    salt VARCHAR(64) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO author (name, country) VALUES
('Дж. Р. Р. Толкин', 'Великобритания'),
('Анджей Сапковский', 'Польша'),
('Михаил Булгаков', 'СССР'),
('Джордж Оруэлл', 'Великобритания'),
('Агата Кристи', 'Великобритания');

INSERT INTO genre (title) VALUES
('Фэнтези'),
('Роман'),
('Антиутопия'),
('Детектив');

INSERT INTO book (title, year, author_id, genre_id) VALUES
('Хоббит', 1937, 1, 1),
('Властелин колец', 1954, 1, 1),
('Последнее желание', 1993, 2, 1),
('Мастер и Маргарита', 1967, 3, 2),
('Собачье сердце', 1925, 3, 2),
('1984', 1949, 4, 3),
('Скотный двор', 1945, 4, 3),
('Убийство в «Восточном экспрессе»', 1934, 5, 4),
('Убийство Роджера Экройда', 1926, 5, 4);

INSERT INTO user (login, email, password_hash, salt) VALUES
('student', 'student@example.com', '$2y$10$IbVCD43.OP1i2Vp64nVymOmTq7nZDkD2rdw77yOr5hZyzPgxA6PqW', '35a5a5637fe57beec88544f9f37bf9a7'),
('ivan', 'ivan@example.com', '$2y$10$4NQtYgbfsex1ZvYGMPphB.B3WWvUpwRsVVd2fYIl1V/1RM0aBpX9a', '9980ef8cf8afedea38cd5b1b9c28148d'),
('olga', 'olga@example.com', '$2y$10$2fvphaNF1KQ05mHMmlKNNeNksqSZOux5MVEkqqfb6/lTtiHsWrTDa', 'ef0cb3fb2f5ea20df746220de6c4a853'),
('admin', 'admin@example.com', '$2y$10$u/laSaRy7mKBYiJBFkoxSuF6zmPehDO8367kGBiB58RIzwoJpEWcu', '6a30b32a2a3d1d38af5839f4ff0bd193');
