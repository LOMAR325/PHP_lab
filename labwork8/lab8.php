<?php

declare(strict_types=1); ?>
<html>

<head>
    <meta charset="utf-8">
    <title>Лабораторная работа №8</title>
</head>

<body>
    <h1>Лабораторная работа №8</h1>
    <hr>

    <h2>Задание 1</h2>

    <?php
    echo "<pre>";

    # 1
    $a = 5;
    $b = &$a;
    echo "# 1: ";
    echo $b = 4, $a;
    echo "\n";

    unset($a, $b);

    # 2
    $a = 4;
    $b = 6;
    $arr = [&$a, &$a];
    $arr[0] = 8;
    echo "# 2: ";
    echo $a, $b;
    echo "\n";

    unset($a, $b, $arr);

    # 3.1
    $a = 2;
    $make = fn() => ++$a;
    $a2 = $make();
    echo "# 3.1: ";
    echo $a, $a2;
    echo "\n";

    # 3.2
    $a = 2;
    $make = fn(&$a) => ++$a;
    $a2 = $make($a);
    echo "# 3.2: ";
    echo $a, $a2;
    echo "\n";

    echo "# 4:\n";

    echo "</pre>";
    ?>

    <iframe src="function_demo.php" width="100%" height="160" style="border: 1px solid #999;"></iframe>

    <h2>Задание 2</h2>

    <?php
    echo "<pre>";

    function sumNumbers(int|float ...$numbers): int|float
    {
        return array_sum($numbers);
    }

    function countElements(array $array): int
    {
        $count = 0;
        foreach ($array as $element) {
            if (is_array($element)) {
                $count += countElements($element);
            } else {
                $count++;
            }
        }
        return $count;
    }

    function showArgsCount(): void
    {
        echo "передано аргументов: ", func_num_args(), "\n";
    }

    $sumFunc = "sumNumbers";
    $countFunc = "countElements";
    $argsFunc = "showArgsCount";

    echo "сумма 1, 2.5, 3, 10: ", $sumFunc(1, 2.5, 3, 10), "\n";
    echo "сумма без аргументов: ", $sumFunc(), "\n";

    try {
        $sumFunc(1, "2");
    } catch (TypeError $e) {
        echo "сумма 1, \"2\": TypeError — строку передать нельзя\n";
    }
    echo "\n";

    $nested = [1, [2, 3, [4, [5, 6]]], 7, [[8]]];
    echo "массив: [1, [2, 3, [4, [5, 6]]], 7, [[8]]]\n";
    echo "элементов (рекурсивно): ", $countFunc($nested), "\n";
    echo "для сравнения count(): ", count($nested), "\n\n";

    $argsFunc();
    $argsFunc("a", "b", "c");
    $argsFunc(1, 2, 3, 4, 5, 6, 7);

    echo "</pre>";
    ?>

    <h2>Задание 3</h2>

    <?php
    echo "<pre>";

    $email = "";

    $add_local_part = function (string $name) use (&$email): void {
        $email .= $name;
    };

    function add_at(): void
    {
        global $email;
        $email .= "@";
    }

    function add_domain(string $domain): void
    {
        $GLOBALS["email"] .= $domain;
    }

    echo "в начале:          '$email'\n";
    $add_local_part("student");
    echo "add_local_part():  '$email'\n";
    add_at();
    echo "add_at():          '$email'\n";
    add_domain("example.com");
    echo "add_domain():      '$email'\n";

    echo "</pre>";
    ?>

    <h2>Задание 4</h2>

    <?php
    echo "<pre>";

    require "ingredients.php";
    require "fridge.php";

    $checkFridge = function () use ($potatoes, $onions, $eggs, $flour, $salt, $oil, $fridge): bool {
        $needed = [
            "картофель" => $potatoes,
            "лук" => $onions,
            "яйца" => $eggs,
            "мука" => $flour,
            "соль" => $salt,
            "масло" => $oil,
        ];

        $enough = true;
        foreach ($needed as $product => $amount) {
            $have = $fridge[$product] ?? 0;
            $status = $have >= $amount ? "хватает" : "НЕ хватает";
            echo "$product: нужно $amount, есть $have — $status\n";
            if ($have < $amount) {
                $enough = false;
            }
        }
        return $enough;
    };

    function cookDraniki(int $potatoes, int $eggs): void
    {
        echo "1. Натереть $potatoes картофелин и лук на мелкой тёрке.\n";
        echo "2. Отжать лишний сок.\n";
        echo "3. Добавить $eggs яйцо, муку и соль, перемешать.\n";
        echo "4. Выкладывать ложкой на разогретую сковороду с маслом.\n";
        echo "5. Жарить по 3–4 минуты с каждой стороны до золотистой корочки.\n";
        echo "Драники готовы!\n";
    }

    if ($checkFridge()) {
        echo "\nПродуктов достаточно, готовим:\n";
        call_user_func("cookDraniki", $potatoes, $eggs);
    } else {
        echo "\nПродуктов недостаточно, нужно сходить в магазин.\n";
    }

    echo "</pre>";
    ?>

    <h2>Задание 5</h2>

    <?php
    echo "<pre>";

    $words = ["привет", "пока", "ура"];

    function addExclamation(array &$array): Generator
    {
        foreach ($array as &$item) {
            $item .= "!";
            yield $item;
        }
    }

    echo "до:\n";
    print_r($words);

    $generator = addExclamation($words);
    echo "после вызова функции, но до перебора:\n";
    print_r($words);

    foreach ($generator as $word) {
        echo "генератор выдал: $word\n";
    }

    echo "после перебора генератора:\n";
    print_r($words);

    echo "</pre>";
    ?>

    <h2>Задание 6</h2>

    <?php
    echo "<pre>";

    date_default_timezone_set("Europe/Minsk");

    $queue = 12;

    function printTicket(int &$queue, string $specialist = "Иванов И. И., терапевт"): void
    {
        static $ticketNumber = 0;
        $ticketNumber++;

        echo "------------------------------\n";
        echo "ТАЛОН № $ticketNumber\n";
        echo "дата и время: ", date("d.m.Y H:i:s"), "\n";
        echo "специалист:   $specialist\n";
        echo "в очереди:    $queue чел.\n";
        echo "------------------------------\n\n";

        $queue = max(0, $queue - rand(1, 3));
    }

    echo "очередь до выдачи талонов: $queue\n\n";

    printTicket($queue);
    printTicket($queue);
    printTicket($queue, "Петрова А. С., стоматолог");

    echo "очередь после выдачи талонов: $queue\n";

    echo "</pre>";
    ?>

    <h2>Задание 7</h2>

    <?php
    echo "<pre>";

    function &getChanging(): int
    {
        static $changing = 0;
        return $changing;
    }

    echo "значение внутри функции: ", getChanging(), "\n";

    $copy = getChanging();
    $copy = 50;
    echo "изменили копию на 50, внутри функции: ", getChanging(), "\n";

    $changing = &getChanging();
    $changing = 100;
    echo "изменили ссылку на 100, внутри функции: ", getChanging(), "\n";

    echo "</pre>";
    ?>

</body>

</html>