<?php
// Задание 2, страница 1: открываем сессию и записываем в неё данные
session_start();

$oldName = session_name();
$oldId = session_id();

// пробуем изменить имя и id, когда сессия уже открыта — PHP не даст
$renameResult = @session_name("MYSESSION");
$changeIdResult = @session_id("vlad123");

// правильный способ сменить id открытой сессии
session_regenerate_id(true);
$newId = session_id();

date_default_timezone_set("Europe/Minsk");

$_SESSION["time"] = date("d.m.Y H:i:s");
$_SESSION["name"] = "Влад";
$_SESSION["age"] = 20;
$_SESSION["subjects"] = [
    "Высокоуровневые языки программирования",
    "Веб-дизайн",
    "Системы управления контентом",
    "Графический дизайн",
];
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Задание 2 — запись в сессию</title>
</head>

<body>
    <h1>Задание 2 — запись в сессию</h1>
    <p><a href="lab9.php">← к лабораторной</a></p>
    <hr>

    <h2>Имя и идентификатор сессии</h2>

    <?php
    echo "<pre>";

    echo "имя сессии:  $oldName\n";
    echo "id сессии:   $oldId\n\n";

    echo "session_name(\"MYSESSION\") после session_start(): ", var_export($renameResult, true), "\n";
    echo "имя осталось: ", session_name(), "\n\n";

    echo "session_id(\"vlad123\") после session_start(): ", var_export($changeIdResult, true), "\n";
    echo "id остался:   ", $oldId, "\n\n";

    echo "session_regenerate_id(true):\n";
    echo "новый id:     $newId\n";

    echo "</pre>";
    ?>

    <h2>Записано в $_SESSION</h2>

    <?php
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
    ?>

    <p><a href="session_read.php">Перейти на другую страницу и прочитать сессию →</a></p>

</body>

</html>
