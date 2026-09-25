<html>

<head>
    <meta charset="utf-8">
    <title>Лабораторная работа №3</title>
</head>

<body>
    <h1>Лабораторная работа №3</h1>
    <hr>

    <h2>Задание 1</h2>

    <?php
    echo "<pre>";

    # 1
    $a = "4";
    $b = "4.4";
    echo "# 1: ", +$a, +$b, "\n";

    # 2
    $a = 5 ** ($b = 2);
    echo "# 2: ", $a, $b, "\n";

    # 3
    $a = 5;
    $b = 6;
    echo "# 3: ", $a <=> $b, "\n";

    # 4
    $a = 0b10001;
    $b = 0b10;
    echo "# 4: ", $a << $b, "\n";

    echo "</pre>";
    ?>

    <h2>Задание 2</h2>

    <?php
    echo "<pre>";

    // арифметические операторы
    $i = 12;      // int
    $f = 4.0;     // float

    echo "Арифметические (int \$i=12, float \$f=4.0):\n";
    echo "\$i + \$f  = ", $i + $f, "\n";
    echo "\$i - \$f  = ", $i - $f, "\n";
    echo "\$i * \$f  = ", $i * $f, "\n";
    echo "\$i / \$f  = ", $i / $f, "\n";
    echo "\$i % 3    = ", $i % 3, "\n";
    echo "\$i ** 2   = ", $i ** 2, "\n";
    echo "-\$i       = ", -$i, "\n\n";

    // побитовые операторы
    echo "Побитовые (\$i=12, \$f=4.0 → приводится к int):\n";
    echo "\$i & \$f  = ", $i & $f, "\n";
    echo "\$i | \$f  = ", $i | $f, "\n";
    echo "\$i ^ \$f  = ", $i ^ $f, "\n";
    echo "~\$i       = ", ~$i, "\n";
    echo "\$i << 2   = ", $i << 2, "\n";
    echo "\$i >> 2   = ", $i >> 2, "\n\n";

    // логические операторы
    $t = true;
    $fl = false;
    echo "Логические (\$t=true, \$fl=false):\n";
    var_dump($t && $fl);
    var_dump($t || $fl);
    var_dump(!$t);
    var_dump($t and $fl);
    var_dump($t or $fl);
    var_dump($t xor $fl);

    echo "\nРазница and/&& и or/||:\n";
    $x = true and false;   // '=' сильнее 'and' - $x = true, потом отброшенное 'and false'
    var_dump($x);
    $y = true && false;    // '&&' сильнее '=' - обычное вычисление
    var_dump($y);

    echo "</pre>";
    ?>

    <h2>Задание 3</h2>

    <?php
    echo "<pre>";

    // присвоение: постфикс vs префикс
    $a = 5;
    echo "a = $a\n";
    echo "a++ вернёт: ", $a++, ", после: $a\n";   // вернёт старое значение 5, затем a=6

    $a = 5;
    echo "++a вернёт: ", ++$a, ", после: $a\n";   // сразу вернёт новое значение 6

    // цикл: постфикс vs префикс
    echo "\nwhile с \$i++ (постфикс, сравнение со СТАРЫМ значением):\n";
    $i = 0;
    while ($i++ < 3) {
        echo $i;
    }
    echo "\n";

    echo "while с ++\$i (префикс, сравнение с НОВЫМ значением):\n";
    $i = 0;
    while (++$i < 3) {
        echo $i;
    }
    echo "\n";

    // декремент
    $a = 5;
    echo "\na-- вернёт: ", $a--, ", после: $a\n";
    $a = 5;
    echo "--a вернёт: ", --$a, ", после: $a\n";

    // инкремент строки
    echo "\nинкремент строки:\n";
    $s = "a";
    $s++;
    var_dump($s);   // "b"
    $s = "z";
    $s++;
    var_dump($s);   // "aa"
    $s = "Az";
    $s++;
    var_dump($s);   // "Ba"
    $s = "a9";
    $s++;
    var_dump($s);   // "b0"

    echo "</pre>";
    ?>

    <h2>Задание 4</h2>

    <?php
    echo "<pre>";

    // вложенное присваивание
    $a = $b = $c = 5;
    echo "вложенное \$a = \$b = \$c = 5:\n";
    var_dump($a, $b, $c);

    // составное присваивание
    echo "\nсоставное присваивание, начиная с \$x = 10:\n";
    $x = 10;
    $x += 5;
    var_dump($x);
    $x -= 3;
    var_dump($x);
    $x *= 2;
    var_dump($x);
    $x /= 4;
    var_dump($x);
    $x **= 2;
    var_dump($x);
    $x %= 4;
    var_dump($x);

    $str = "привет";
    $str .= " мир";
    var_dump($str);

    $x = 12;
    $x &= 10;
    var_dump($x);
    $x = 12;
    $x |= 3;
    var_dump($x);
    $x = 12;
    $x ^= 5;
    var_dump($x);
    $x = 3;
    $x <<= 2;
    var_dump($x);
    $x = 12;
    $x >>= 2;
    var_dump($x);

    $x = null;
    $x ??= "значение по умолчанию";   // присвоит, только если было null
    var_dump($x);

    echo "</pre>";
    ?>

    <h2>Задание 5</h2>

    <?php
    echo "<pre>";

    // строка . строка
    echo "строка . строка: ", "фыв" . "апр", "\n";

    // число . строка
    echo "число . строка: ", 5 . " строка", "\n";

    // строка . массив
    echo "строка . массив: ";
    echo "текст " . [1, 2, 3];

    echo "</pre>";
    ?>

    <h2>Задание 6</h2>

    <?php
    echo "<pre>";

    // void — функция ничего не возвращает
    function logMessage(string $message): void
    {
        echo $message, "\n";
        // return 1; — так писать нельзя, только "return;" или без return вовсе
    }

    // never — функция никогда не возвращает управление обычным путём
    function stopExecution(): never
    {
        throw new Exception("выполнение остановлено");
    }

    logMessage("void: просто вывели строку, ничего не вернули");

    try {
        stopExecution();
    } catch (Exception $e) {
        echo "поймали исключение из never-функции: " . $e->getMessage() . "\n";
    }

    echo "</pre>";
    ?>



    <?php
    $a = "G";
    $a++;
    $a++;
    $a++;
    echo $a;
    ?>

</body>

</html>