<html>

<head>
    <meta charset="utf-8">
    <title>Лабораторная работа №9</title>
</head>

<body>
    <h1>Лабораторная работа №9</h1>
    <hr>

    <h2>Задание 1</h2>

    <p>
        Страница для эксперимента: <a href="cookies.php">cookies.php</a> —
        открыть сессию, завершить её и смотреть куки в DevTools → Application → Cookies.
    </p>

    <?php
    $screenshots = glob("screenshots/*.png");

    foreach ($screenshots as $file) {
        $name = basename($file, ".png");
        echo "<p><b>$name</b><br>";
        echo "<img src='screenshots/", rawurlencode(basename($file)), "' style='max-width: 100%; border: 1px solid #999;'></p>";
    }
    ?>

    <p>
        <b>Почему изменились куки.</b>
        До открытия сессии кука PHPSESSID отсутствует. session_start() создаёт сессию на сервере
        и отправляет браузеру заголовок Set-Cookie: PHPSESSID=&lt;id&gt; — браузер сохраняет куку
        и дальше присылает её с каждым запросом, по ней сервер узнаёт «свою» сессию.
        session_destroy() удаляет данные сессии только на сервере, кука в браузере остаётся;
        чтобы удалить и её, нужно отправить setcookie() с тем же именем и временем в прошлом.
    </p>

    <h2>Задание 2</h2>

    <p>
        <a href="session_write.php">session_write.php</a> — открывает сессию, выводит её имя и id,
        пытается их изменить и записывает данные в $_SESSION.
        <br>
        <a href="session_read.php">session_read.php</a> — другая страница, читает эти данные из $_SESSION.
    </p>

    <h2>Задание 3</h2>

    <p>
        Сайт с выбором языка: <a href="site/index.php">site/index.php</a>.
        <br>
        Страницы index.php, sights.php, food.php связаны меню в хедере (header.php, подключается через require).
        Язык выбирается в select, форма отправляется методом POST, значение записывается в сессию,
        тексты берутся из lang.php.
    </p>

</body>

</html>
