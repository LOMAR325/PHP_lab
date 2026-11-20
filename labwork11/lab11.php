<?php
require_once "db.php";
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Лабораторная работа №11</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Лабораторная работа №11. Базы данных</h1>
    <hr>

    <p class="ok"><?= $dbMessage ?></p>

    <h2>Задание 1</h2>
    <p>Логическая схема базы данных <b>library</b> (библиотека):</p>
    <img src="schema.svg" alt="ER-диаграмма базы данных library" width="700">
    <p>
        Таблицы созданы в phpMyAdmin (SQL для создания и заполнения — в файле <code>library.sql</code>),
        подключение к базе — в файле <code>db.php</code>.
    </p>
    <p><a href="task1.php">Содержимое всех таблиц →</a></p>

    <h2>Задание 2</h2>
    <p><a href="task2.php">Добавление авторов, жанров и книг через формы →</a></p>

    <h2>Задание 3</h2>
    <p><a href="task3.php">Поиск книг по части названия →</a></p>

    <h2>Задание 4</h2>
    <p><a href="task4.php">Регистрация пользователя →</a></p>

    <h2>Задание 5</h2>
    <p><a href="task5.php">Просмотр и изменение пользователя →</a></p>

    <h2>Задание 6</h2>
    <p><a href="task6/index.php">Мини-проект «Библиотека»: вход, главная, личный кабинет →</a></p>

    <hr>
    <p class="hint">phpMyAdmin: <a href="http://localhost:8888/phpMyAdmin5/">localhost:8888/phpMyAdmin5</a> (логин root, пароль root)</p>
</body>

</html>
