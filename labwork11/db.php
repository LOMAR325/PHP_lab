<?php
const DB_HOST = "localhost";
const DB_PORT = 8889;          
const DB_NAME = "library";
const DB_USER = "root";
const DB_PASS = "root";

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
        ]
    );

    $dbMessage = "Подключение к базе «" . DB_NAME . "» установлено";
} catch (PDOException $e) {
    echo "<p style='color: red'>Ошибка подключения к базе данных: ", htmlspecialchars($e->getMessage()), "</p>";
    exit;
}
