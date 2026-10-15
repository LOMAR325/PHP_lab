<html>

<head>
    <meta charset="utf-8">
    <title>Лабораторная работа №6</title>
</head>

<body>
    <h1>Лабораторная работа №6</h1>
    <hr>

    <h2>Задание 1</h2>

    <?php
    echo "<pre>";

    // деструктуризация
    $colors = ["красный", "зелёный", "синий", "жёлтый"];

    [$first, $second] = $colors;                       
    echo "[] :     first = $first, second = $second\n";

    list(, , $third, $fourth) = $colors;              
    echo "list() : third = $third, fourth = $fourth\n";

    $user = ["name" => "Влад", "age" => 20];
    list("name" => $name, "age" => $age) = $user;      
    echo "list() по ключам: name = $name, age = $age\n\n";

    // удаление неуникальных значений
    $numbers = [1, 2, 2, 3, 4, 4, 4, 5];
    echo "исходный массив:      ", implode(", ", $numbers), "\n";

    // убрать повторы, оставив по одному экземпляру
    echo "array_unique:         ", implode(", ", array_unique($numbers)), "\n\n";

    // количество повторений значения
    $counts = array_count_values($numbers);            
    $value = 4;
    echo "array_count_values:   ";
    print_r($counts);
    echo "значение $value встречается ", $counts[$value], " раз(а)\n\n";
    
    // дополнение массива до заданной длины
    $short = [10, 20, 30];
    echo "array_pad до 6 нулями справа: ", implode(", ", array_pad($short, 6, 0)), "\n";
    echo "array_pad до 6 нулями слева:  ", implode(", ", array_pad($short, -6, 0)), "\n";

    echo "</pre>";
    ?>

    <h2>Задание 2</h2>

    <?php
    echo "<pre>";

    // функция-генератор одной случайной строки длиной от 1 до 10 латинских букв
    $randomString = fn() => substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 10)), 0, rand(1, 10));

    // range(1, 6) — просто 6 "заготовок", array_map для каждой вызывает генератор
    $strings = array_map(fn() => $randomString(), range(1, 6));
    echo "первый массив:\n";
    print_r($strings);

    $limit = 7;
    $hasLong = array_any($strings, fn($s) => strlen($s) > $limit);
    echo "есть ли строка длиннее $limit символов: ", var_export($hasLong, true), "\n";

    $allLonger = array_all($strings, fn($s) => strlen($s) > 1);
    echo "все ли строки длиннее 1 символа:   ", var_export($allLonger, true), "\n";

    $shortCount = count(array_filter($strings, fn($s) => strlen($s) < 5));
    echo "строк короче 5 символов:           $shortCount\n\n";

    // второй массив тем же способом
    $strings2 = array_map(fn() => $randomString(), range(1, 6));
    echo "второй массив:\n";
    print_r($strings2);

    echo "расхождение (есть в 1-м, нет во 2-м):\n";
    print_r(array_diff($strings, $strings2));
    echo "пересечение (есть в обоих):\n";
    print_r(array_intersect($strings, $strings2));

    // случайные строки почти никогда не совпадают, поэтому наглядный пример на фиксированных данных
    $x = ["cat", "dog", "fox", "owl"];
    $y = ["dog", "owl", "bee"];
    echo "\nнаглядно: x = [cat, dog, fox, owl], y = [dog, owl, bee]\n";
    echo "array_diff(x, y):      ", implode(", ", array_diff($x, $y)), "\n";
    echo "array_intersect(x, y): ", implode(", ", array_intersect($x, $y)), "\n";

    echo "</pre>";
    ?>

    <h2>Задание 3</h2>

    <?php
    echo "<pre>";

    $fantasy_books = [
        [
            "id" => 123,
            "title" => "Властелин колец",
            "author" => "Дж. Р. Р. Толкин"
        ],
        [
            "id" => 345,
            "title" => "Песнь льда и огня",
            "author" => "Дж. Р. Р. Мартин"
        ],
        [
            "id" => 678,
            "title" => "Ведьмак",
            "author" => "А. Сапковский"
        ],
        [
            "id" => 124,
            "title" => "Колесо времени",
            "author" => "Р. Джордан"
        ],
        [
            "id" => 356,
            "title" => "Плоский мир",
            "author" => "Т. Пратчетт"
        ]
    ];

    $titles = array_column($fantasy_books, "title");
    echo "названия:\n";
    print_r($titles);

    $authors = array_column($fantasy_books, "author");
    echo "авторы:\n";
    print_r($authors);

    // третий аргумент — какое поле сделать ключом
    echo "название => автор:\n";
    print_r(array_column($fantasy_books, "author", "title"));

    echo "id => название:\n";
    print_r(array_column($fantasy_books, "title", "id"));

    echo "</pre>";
    ?>

    <h2>Задание 4</h2>

    <?php
    echo "<pre>";

    $temperatures = [
        "2025-07-01" => 18.5,
        "2025-07-02" => 19.0,
        "2025-07-03" => 23.4,
        "2025-07-04" => 21.7,
        "2025-07-05" => 25.1,
        "2025-07-06" => 17.9,
        "2025-07-07" => 22.3,
        "2025-07-08" => 24.6,
    ];
    print_r($temperatures);

    // фильтр по ключу и значению одновременно: число месяца чётное и температура > 20
    $suitable = array_filter(
        $temperatures,
        fn($temp, $date) => (int) substr($date, 8, 2) % 2 === 0 && $temp > 20,
        ARRAY_FILTER_USE_BOTH
    );
    echo "все подходящие дни:\n";
    print_r($suitable);

    $day = array_key_first($suitable);                     // берём первый подходящий
    echo "найденный день: $day, температура: {$temperatures[$day]}°\n";

    $index = array_search($day, array_keys($temperatures)); // позиция среди всех дат (с нуля)
    echo "номер от начала: ", $index + 1, "\n";
    echo "номер от конца:  ", count($temperatures) - $index, "\n\n";

    echo "сумма:        ", array_sum($temperatures), "\n";
    echo "произведение: ", array_product($temperatures), "\n";
    echo "минимум:      ", min($temperatures), "\n";
    echo "максимум:     ", max($temperatures), "\n";

    echo "</pre>";
    ?>

    <h2>Задание 5</h2>

    <?php
    echo "<pre>";

    $animals = ["кот", "пёс", "лис", "ёж", "волк", "заяц", "барсук", "лось", "рысь"];
    echo "исходный массив: ", implode(", ", $animals), "\n\n";

    echo "первый элемент:   ", array_shift($animals), "\n";   // вынимает и удаляет первый
    echo "последний элемент: ", array_pop($animals), "\n\n";   // вынимает и удаляет последний

    echo "оставшийся массив: ", implode(", ", $animals), "\n\n";

    echo "разбиение по 2:\n";
    print_r(array_chunk($animals, 2));

    echo "</pre>";
    ?>

</body>

</html>
