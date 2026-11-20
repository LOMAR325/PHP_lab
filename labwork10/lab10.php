<html>

<head>
    <meta charset="utf-8">
    <title>Лабораторная работа №10</title>
    <style>
        .error {
            color: red;
        }

        .ok {
            color: green;
        }

        label {
            display: inline-block;
            width: 140px;
        }
    </style>
</head>

<body>
    <h1>Лабораторная работа №10</h1>
    <hr>

    <h2 id="task1">Задание 1</h2>

    <?php
    $rules = [
        "fio" => ['/^[A-ZА-ЯЁ][a-zа-яё]*(?: [A-ZА-ЯЁ][a-zа-яё]*)*$/u', "Каждое слово с заглавной буквы, без цифр"],
        "birth" => ['/^\d{2}\.\d{2}\.\d{4}$/', "Формат 01.01.1970"],
        "email" => ['/^([a-zA-Z0-9]{4,20})@[a-z]{2,10}\.(?:ru|com|by)$/', "Формат first@second.third"],
        "phone" => ['/^8 0(?:29|44|33) \d{3}-\d{3}-\d{2}$/', "Формат 8 029 111-111-11"],
    ];
    $values = [];
    $errors = [];

    $sent1 = isset($_POST["fio"]);

    if ($sent1) {
        foreach ($rules as $field => [$regex, $message]) {
            $values[$field] = trim($_POST[$field] ?? "");
            if (!preg_match($regex, $values[$field])) {
                $errors[$field] = $message;
            }
        }
    }
    ?>

    <form method="post" action="#task1">
        <p>
            <label>ФИО</label>
            <input type="text" name="fio" value="<?= htmlspecialchars($values["fio"] ?? "") ?>" placeholder="Иванов Иван Иванович">
            <span class="error"><?= $errors["fio"] ?? "" ?></span>
        </p>
        <p>
            <label>Дата рождения</label>
            <input type="text" name="birth" value="<?= htmlspecialchars($values["birth"] ?? "") ?>" placeholder="01.01.1970">
            <span class="error"><?= $errors["birth"] ?? "" ?></span>
        </p>
        <p>
            <label>E-mail</label>
            <input type="text" name="email" value="<?= htmlspecialchars($values["email"] ?? "") ?>" placeholder="student1@mail.ru">
            <span class="error"><?= $errors["email"] ?? "" ?></span>
        </p>
        <p>
            <label>Телефон</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($values["phone"] ?? "") ?>" placeholder="8 029 111-111-11">
            <span class="error"><?= $errors["phone"] ?? "" ?></span>
        </p>
        <button type="submit">Проверить</button>
    </form>

    <?php if ($sent1 && count($errors) === 0): ?>
        <p class="ok">Все данные введены правильно!</p>
    <?php endif; ?>

    <h2>Задание 2</h2>

    <?php
    require "xss.php";

    echo "<p><b>Исходная строка (как код):</b></p>";
    echo "<pre>", htmlspecialchars($xss), "</pre>";

    $cleaned = preg_replace([
        '/<script\b[^>]*>.*?<\/script>/is',
        '/\son\w+\s*=\s*("[^"]*"|\'[^\']*\')/i',
    ], "", $xss);

    echo "<p><b>Результат — опасное вырезано, остальной HTML работает:</b></p>";
    echo $cleaned;
    ?>

    <h2>Задание 3</h2>

    <?php
    echo "<pre>";

    $spaces = "М н о г о  п р о б е л о в";
    echo "1) было:  $spaces\n";
    echo "   стало: ", preg_replace('/ ( )?/', '$1', $spaces), "\n\n";

    $text = "Цена 12.50, скидка -3, осталось 7 шт. и 1,5 кг";
    preg_match_all('/-?\d+(?:[.,]\d+)?/', $text, $numbers);
    echo "2) строка: $text\n";
    echo "   числа:  ", implode(" | ", $numbers[0]), "\n\n";

    $poem = <<<TEXT
Если бы я, “если б я” был австрийцем,
То наверно купил бы “маленький дом”,
Маленький дом архитектора “Хундертвассера,
И мы” бы тайно встречались “в нём”.
TEXT;
    preg_match_all('/“(.*?)”/su', $poem, $quotes);
    echo "3) в кавычках:\n";
    print_r($quotes[1]);
    echo "\n";

    $sentence = "Раз, два: три; четыре – пять.";
    echo "4) строка: $sentence\n";
    print_r(preg_split('/\s*[.,:;–]\s*/u', $sentence, -1, PREG_SPLIT_NO_EMPTY));

    echo "</pre>";
    ?>

    <h2>Задание 4</h2>

    <?php
    echo "<pre>";

    $template = "Good {time}, dear {name}! You look {prop} today!";
    $source = "_evening_, **Friend**, PROP great PROP";

    preg_match('/_(\w+?)_.*?\*\*(\w+)\*\*.*?PROP (\w+) PROP/', $source, $words);

    $letter = preg_replace(
        ['/\{time\}/', '/\{name\}/', '/\{prop\}/'],
        [$words[1], $words[2], $words[3]],
        $template
    );

    echo "шаблон: $template\n";
    echo "слова:  $source\n";
    echo "письмо: $letter\n";

    echo "</pre>";
    ?>

    <h2 id="task5">Задание 5</h2>

    <?php
    $passwordRegex = '/^(?=.*\p{Ll})(?=.*\p{Lu})(?=.*\d)(?=.*[!@#%^&*])(?!.*(.)\1)\S{8,}$/u';
    ?>

    <form method="post" action="#task5">
        <label>Пароль</label>
        <input type="text" name="password">
        <button type="submit">Проверить</button>
    </form>

    <?php
    if (isset($_POST["password"])) {
        if (preg_match($passwordRegex, $_POST["password"])) {
            echo "<p class='ok'>Пароль подходит</p>";
        } else {
            echo "<p class='error'>Пароль не подходит</p>";
        }
    }

    $examples = ["Pas5w0rd!", "Пар0ль!Ok", "Passw0rd!", "Short1!", "pas5w0rd!", "Pas5w0rd", "Pas5 w0rd!"];

    echo "<pre>";
    foreach ($examples as $example) {
        $result = preg_match($passwordRegex, $example) ? "подходит" : "не подходит";
        echo "$example → $result\n";
    }
    echo "</pre>";
    ?>

    <h2>Задание 6</h2>

    <?php
    echo "<pre>";

    $log = <<<LOG
[2025-11-03 18:52:40] PHP-8.3-FCGI (default): Инициализация модуля
[2025-11-03 18:52:40] PHP-8.4-FCGI (default): Инициализация модуля
[2025-11-03 18:52:41] PHP-8.3 (default): Рабочий процесс модуля запущен
[2025-11-03 18:52:41] PHP-8.4 (default): Рабочий процесс модуля запущен
[2025-11-03 18:53:10] PHP-7.4 (default): Рабочий процесс модуля запущен
LOG;

    echo "лог:\n$log\n\nрезультат:\n";

    preg_match_all(
        '/^\[(\d{4})-(\d{2})-(\d{2}) (\d{2}:\d{2}):\d{2}\] (PHP-8\.\d+) \(/mu',
        $log,
        $matches,
        PREG_SET_ORDER
    );

    foreach ($matches as $m) {
        echo "Модуль $m[5] – $m[3].$m[2].$m[1] в $m[4]\n";
    }

    echo "</pre>";
    ?>

    <h2>Задание 7</h2>

    <?php
    echo "<pre>";

    $date = "1970-01-01";
    echo "$date → ", preg_replace('/(\d{4})-(\d{2})-(\d{2})/', '$3.$2.$1', $date), "\n";

    echo "</pre>";
    ?>

    <h2>Задание 8</h2>

    <?php
    echo "<pre>";

    $ipRegex = '/^(?:(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)\.){3}(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)$/';

    $ips = ["192.168.0.1", "0.0.0.0", "255.255.255.255", "256.1.1.1", "01.2.3.4", "1.2.3", "1.2.3.4.5"];

    foreach ($ips as $ip) {
        $result = preg_match($ipRegex, $ip) ? "корректный" : "некорректный";
        echo "$ip → $result\n";
    }

    echo "</pre>";
    ?>

</body>

</html>