<html>

<head>
    <meta charset="utf-8">
    <title>Лабораторная работа №4</title>
</head>

<body>
    <h1>Лабораторная работа №4</h1>
    <hr>

    <h2>Задание 1</h2>

    <?php
    echo "<pre>";

    // Выражение 1:
    $x = 1;
    $y1 = exp(sqrt(cos($x) * ($x ** 2 + $x)));
    echo "Выражение 1: y = ", round($y1, 2), "\n";

    // Выражение 2:
    $x = 4;
    $numerator = sin(5 * $x) + 2 * cos(2 * $x);
    $denominator = sqrt($x - 1) + log($x);
    if ($denominator == 0) {
        echo "Выражение 2: знаменатель равен нулю — деление невозможно\n";
    } else {
        echo "Выражение 2: y = ", round($numerator / $denominator, 2), "\n";
    }

    // Выражение 3: 
    $a = mt_rand(0, 10);
    $b = mt_rand(0, 10);
    echo "Выражение 3: a=$a, b=$b\n";
    $numerator3 = sqrt(32 * $a ** 10 + 4 * $a ** 15) - 3 * $a ** 4;
    $denominator3 = $b ** 2 + 8 * $b ** 2;
    if ($denominator3 == 0) {
        echo "Выражение 3: b = 0 → знаменатель равен нулю, деление невозможно\n";
    } else {
        echo "Выражение 3: y = ", round($numerator3 / $denominator3, 2), "\n";
    }

    // Выражение 4: 
    $y4 = cos(M_PI_2) + 4 * sin(M_PI_4) ** 2 - 3 * sqrt(2) * cos(M_PI);
    echo "Выражение 4: y = ", round($y4, 2), "\n";

    echo "</pre>";
    ?>

    <h2>Задание 2</h2>

    <?php
    echo "<pre>";

    $e1 = rand(-5, 5);                              // rand() — целое [-5, 5]
    $e2 = random_int(1, 10);                        // random_int() — целое [1, 10]
    $e3 = mt_rand(-2000, 2000) / 1000;               // mt_rand() — дробное [-2, 2]
    $e4 = (mt_rand() / mt_getrandmax()) * 2 - 1;     // свой способ — дробное [-1, 1]

    $numbers = [$e1, $e2, $e3, $e4];
    var_dump($numbers);

    $hyp1 = hypot($numbers[0], $numbers[1]);   // hypot() — гипотенуза по двум катетам
    $hyp2 = hypot($numbers[2], $numbers[3]);

    echo "Гипотенуза 1 (катеты {$numbers[0]} и {$numbers[1]}) = ", round($hyp1, 2), "\n";
    echo "Гипотенуза 2 (катеты {$numbers[2]} и {$numbers[3]}) = ", round($hyp2, 2), "\n";

    echo "</pre>";
    ?>

    <h2>Задание 3</h2>

    <?php
    echo "<pre>";

    $intN = rand(3, 9);
    $floatN = mt_rand(500, 900) / 10;

    echo "int = $intN, float = $floatN\n\n";

    echo "округление вниз, floor(float) = ", floor($floatN), "\n";
    echo "округление вверх, ceil(float)  = ", ceil($floatN), "\n\n";

    echo "остаток от деления, fmod(float, int) = ", fmod($floatN, $intN), "\n\n";

    $intM = rand(2, 9);
    echo "int2 = $intM\n";
    echo "деление без остатка, intdiv(int, int2) = ", intdiv($intN, $intM), "\n";

    echo "</pre>";
    ?>

    <h2>Задание 4</h2>

    <?php
    echo "<pre>";

    $length = rand(3, 8);
    $numbers = [];
    for ($i = 0; $i < $length; $i++) {
        $numbers[] = mt_rand(-500, 500) / 10;   // случайное число от -50.0 до 50.0
    }

    echo "длина массива: $length\n";
    var_dump($numbers);

    $max = max($numbers);
    $min = min($numbers);
    echo "max = $max, min = $min\n\n";

    // fdiv() не бросает ошибку при делении на 0, а по стандарту IEEE 754
    // возвращает INF / -INF / NAN — это и есть "обработка" деления на ноль
    $result = fdiv($max, $min);
    var_dump($result);

    echo "is_finite:   ", var_export(is_finite($result), true), "\n";
    echo "is_infinite: ", var_export(is_infinite($result), true), "\n";
    echo "is_nan:      ", var_export(is_nan($result), true), "\n\n";

    // для сравнения — как ведёт себя обычное деление на 0
    try {
        $plain = $max / $min;
        echo "обычное деление сработало: $plain\n";
    } catch (\DivisionByZeroError $e) {
        echo "обычное деление выбросило ошибку: " . $e->getMessage() . "\n";
    }

    echo "</pre>";
    ?>

    <h2>Задание 5</h2>

    <?php
    echo "<pre>";

    $numbers = [
        ["101101", 2],    // двоичное
        ["757", 8],       // восьмеричное
        ["2AF", 16],      // шестнадцатеричное
        ["Z9", 36],       // 36-ричное
    ];

    foreach ($numbers as [$str, $base]) {
        $dec = (int) base_convert($str, $base, 10);   // приводим к десятичному
        $ln = log($dec);                               // натуральный логарифм
        $deg = rad2deg($ln);                            // из радиан в градусы

        echo "\"$str\" (основание $base) → десятичное: $dec, ln = "
            . round($ln, 4) . ", в градусах: " . round($deg, 2) . "\n";
    }

    echo "</pre>";
    ?>

</body>

</html>