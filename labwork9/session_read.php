<?php
// Задание 2, страница 2: та же сессия, другой файл
session_start();
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Задание 2 — чтение сессии</title>
</head>

<body>
    <h1>Задание 2 — чтение сессии</h1>
    <p><a href="lab9.php">← к лабораторной</a></p>
    <hr>

    <?php
    echo "<pre>";

    echo "id сессии: ", session_id(), "\n\n";

    if (isset($_SESSION["name"])) {
        echo "время записи:  {$_SESSION["time"]}\n";
        echo "имя:           {$_SESSION["name"]}\n";
        echo "возраст:       {$_SESSION["age"]}\n";
        echo "любимые предметы:\n";
        foreach ($_SESSION["subjects"] as $i => $subject) {
            echo "  ", $i + 1, ". $subject\n";
        }
    } else {
        echo "в сессии нет данных — сначала откройте session_write.php\n";
    }

    echo "</pre>";
    ?>

    <p><a href="session_write.php">← Вернуться и перезаписать данные</a></p>

</body>

</html>
