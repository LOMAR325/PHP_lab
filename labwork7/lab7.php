<html>

<head>
    <meta charset="utf-8">
    <title>Лабораторная работа №7</title>
</head>

<body>
    <h1>Лабораторная работа №7</h1>
    <hr>

    <h2>Часть 1</h2>

    <h2>Задание 1</h2>

    <?php
    echo "<pre>";

    # 1
    for ($i = 6; $i < 4; $i++) {
        echo "Ё ма со, ё ма хо";
    }
    echo "# 1: ", "i = $i", "\n";

    # 2
    echo "# 2: ";
    $i = 2;
    while ($i < 10) {
        echo ++$i;
        if ($i == 6) {
            break;
        }
        $i++;
    }
    echo $i, "\n";

    # 3
    $a = 2;
    for ($b = 0; $b < 5; $b++) {
        $a += $b;
    }
    echo "# 3: ", $a . ", " . $b, "\n";

    echo "# 4.1: ";
    $i = 1;
    $guard = 0;
    while ($i <= 5) {
        echo $i;
        $guard++;
        if ($guard == 10) {
            echo "... (и так бесконечно)";
            break;
        }
    }
    echo "\n";

    # 4.2
    echo "# 4.2: ";
    $i = 1;
    do {
        echo $i++;
    } while ($i < -1);
    echo "\n";

    echo "</pre>";
    ?>

    <h2>Задание 2</h2>

    <?php
    echo "<pre>";

    function canDrive(int $age, bool $hasLicense, bool $isDrunk): string
    {
        if ($age < 18) {
            return "нельзя: возраст меньше 18";
        } elseif (!$hasLicense) {
            return "нельзя: нет водительских прав";
        } elseif ($isDrunk) {
            return "нельзя: водитель пьян";
        } else {
            return "можно садиться за руль";
        }
    }

    $age = 25;
    $hasLicense = true;
    $isDrunk = false;
    echo "возраст $age, права: ", var_export($hasLicense, true), ", пьян: ", var_export($isDrunk, true),
        " → ", canDrive($age, $hasLicense, $isDrunk), "\n";

    echo "16, права, трезв   → ", canDrive(16, true, false), "\n";
    echo "30, без прав, трезв → ", canDrive(30, false, false), "\n";
    echo "30, права, пьян     → ", canDrive(30, true, true), "\n";

    echo "</pre>";
    ?>

    <h2>Задание 3</h2>

    <?php
    echo "<pre>";

    $hour = rand(0, 23);

    if ($hour < 0 || $hour > 23) {
        $timeOfDay = "некорректный час";
    } elseif ($hour >= 4 && $hour <= 11) {
        $timeOfDay = "утро";
    } elseif ($hour >= 12 && $hour <= 16) {
        $timeOfDay = "день";
    } elseif ($hour >= 17 && $hour <= 22) {
        $timeOfDay = "вечер";
    } else {
        $timeOfDay = "ночь";
    }

    echo "час: $hour → $timeOfDay\n";

    echo "</pre>";
    ?>

    <h2>Задание 4</h2>

    <?php
    echo "<pre>";

    echo "кроме кратных 4:          ";
    for ($i = 1; $i <= 30; $i++) {
        if ($i % 4 == 0) {
            continue;
        }
        echo $i, " ";
    }
    echo "\n";

    echo "кроме нечётных:           ";
    for ($i = 1; $i <= 30; $i++) {
        if ($i % 2 != 0) {
            continue;
        }
        echo $i, " ";
    }
    echo "\n";

    echo "кроме суммы цифр = 5:     ";
    for ($i = 1; $i <= 30; $i++) {
        $digitSum = intdiv($i, 10) + $i % 10;  
        if ($digitSum == 5) {
            continue;
        }
        echo $i, " ";
    }
    echo "\n";

    echo "пока сумма не равна 42:   ";
    $sum = 0;
    for ($i = 1; $i <= 30; $i++) {
        if ($i % 2 != 0) {
            continue;
        }
        echo $i, " ";
        $sum += $i;
        if ($sum == 42) {
            break;
        }
    }
    echo " (сумма = $sum)\n";

    echo "не больше 5 значений:     ";
    $count = 0;
    $i = 1;
    while ($i <= 30) {
        echo $i, " ";
        $count++;
        if ($count == 5) {
            break;
        }
        $i++;
    }
    echo "\n";

    echo "</pre>";
    ?>

    <h2>Задание 5</h2>

    <?php
    echo "<pre>";

    $floors = rand(3, 9);
    echo "этажей: $floors\n\n";

    for ($floor = 1; $floor <= $floors; $floor++) {
        $edge = $floors - $floor + 1;                  
        echo str_repeat("/", $edge)
            . str_repeat($floor, 2 * $floor - 1)      
            . str_repeat("\\", $edge)
            . "\n";
    }

    echo "</pre>";
    ?>

    <h2>Задание 6</h2>

    <?php
    echo "<pre>";

    function checkPassword(string $password): array
    {
        $errors = [];

        if (strlen($password) <= 8) {
            $errors[] = "длина должна быть больше 8 символов";
        }

        $hasDigit = false;
        $hasUpper = false;
        for ($i = 0; $i < strlen($password); $i++) {
            $char = $password[$i];
            if (ctype_digit($char)) {
                $hasDigit = true;
            }
            if (ctype_upper($char)) {
                $hasUpper = true;
            }
        }

        if (!$hasDigit) {
            $errors[] = "нужна хотя бы одна цифра";
        }
        if (!$hasUpper) {
            $errors[] = "нужна хотя бы одна заглавная буква";
        }

        return $errors;
    }

    $passwords = ["qwerty", "longpassword", "longpassword1", "LongPassword1"];

    foreach ($passwords as $password) {
        $errors = checkPassword($password);
        if (count($errors) == 0) {
            echo "$password → пароль корректный\n";
        } else {
            echo "$password → ", implode("; ", $errors), "\n";
        }
    }

    echo "</pre>";
    ?>

    <h2>Задание 7</h2>

    <?php
    echo "<pre>";

    function buyCards(string $birthDate): void
    {
        $birth = new DateTimeImmutable($birthDate);
        $today = new DateTimeImmutable("today");
        $age = $birth->diff($today)->y;                

        echo "дата рождения: $birthDate, полных лет: $age\n";

        if ($age < 18) {
            $adultDay = $birth->modify("+18 years");   
            $wait = $today->diff($adultDay);
            echo "купить нельзя, осталось: {$wait->y} лет, {$wait->m} мес., {$wait->d} дн.\n\n";
        } else {
            $suit = rand(1, 4);
            switch ($suit) {
                case 1:
                    echo "купить можно, масть: ♠ пики\n\n";
                    break;
                case 2:
                    echo "купить можно, масть: ♥ червы\n\n";
                    break;
                case 3:
                    echo "купить можно, масть: ♦ бубны\n\n";
                    break;
                case 4:
                    echo "купить можно, масть: ♣ трефы\n\n";
                    break;
            }
        }
    }

    buyCards("2010-05-14");
    buyCards("2001-09-03");

    echo "</pre>";
    ?>

    <hr>

    <h2>Часть 2</h2>

    <h2>Задание 1</h2>

    <?php
    echo "<pre>";

    # 1
    echo "# 1: ", match (4) {
        '4' => 'string',
        4 => 'int',
        default => 'none'
    }, "\n";

    # 2
    echo "# 2: ";
    $items = [1, 2, 'stop', 4];
    foreach ($items as $item) {
        switch ($item) {
            case 'stop':
                continue 2;
            default:
                echo $item;
        }
        echo $item;
    }
    echo "\n";

    # 3
    echo "# 3: ";
    require_once 'header.php';
    require_once 'header.php';
    echo 'Готово';
    echo "\n";

    # 4 
    echo "# 4:\n";

    echo "</pre>";
    ?>

    <iframe src="include_demo.php" width="100%" height="220" style="border: 1px solid #999;"></iframe>

    <h2>Задание 2</h2>

    <?php
    const ADMIN = "Влад";

    $users = [null, "Пётр", "Влад"];
    ?>

    <?php foreach ($users as $user): ?>
        <p>
            $user = <?= var_export($user, true) ?> →
            <?php if ($user === null): ?>
                пользователь не вошёл в систему
            <?php elseif ($user === ADMIN): ?>
                вошёл администратор <b><?= $user ?></b>
            <?php else: ?>
                вошёл пользователь <?= $user ?>, но он не администратор
            <?php endif; ?>
        </p>
    <?php endforeach; ?>

    <h2>Задание 3</h2>

    <?php
    $cameras = [
        ['title' => 'Nikon Z8', 'prices' => [15000, 17992, 9229]],
        ['title' => 'Canon EOS R5', 'prices' => [14500, 8961, 13950]],
        ['title' => 'Sony Alpha a7 IV', 'prices' => [8799, 11146, 12457]],
    ];

    echo "<table border='1' cellpadding='6'>";
    echo "<tr><td>Модель</td><td>Цены</td><td>Средняя цена</td></tr>";

    foreach ($cameras as $camera) {
        $prices = "";
        foreach ($camera['prices'] as $price) {
            $prices .= $price . " ";
        }
        $average = array_sum($camera['prices']) / count($camera['prices']);

        echo "<tr>";
        echo "<td>{$camera['title']}</td>";
        echo "<td>$prices</td>";
        echo "<td>" . round($average, 2) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    ?>

    <h2>Задание 4</h2>

    <?php
    echo "<pre>";

    $first = rand(1, 5);
    echo "первое число: $first → ";
    switch ($first):
        case 1:
            echo "красный";
            break;
        case 2:
            echo "оранжевый";
            break;
        case 3:
            echo "жёлтый";
            break;
        case 4:
            echo "зелёный";
            break;
        case 5:
            echo "синий";
            break;
    endswitch;
    echo "\n";

    $second = rand(1, 5);
    echo "второе число: $second → ";
    switch ($second):
        case 1:
            echo "красный ";
        case 2:
            echo "оранжевый ";
        case 3:
            echo "жёлтый ";
        case 4:
            echo "зелёный ";
        case 5:
            echo "синий ";
    endswitch;
    echo "\n";

    echo "</pre>";
    ?>

    <h2>Задание 5</h2>

    <?php
    echo "<pre>";

    $month = rand(0, 12);

    $season = match ($month) {
        12, 1, 2 => "зимний месяц",
        3, 4, 5 => "весенний месяц",
        6, 7, 8 => "летний месяц",
        9, 10, 11 => "осенний месяц",
        0 => "0 — такого месяца не существует",
    };

    echo "число: $month - $season\n";

    echo "</pre>";
    ?>

    <h2>Задание 6</h2>

    <p>
        Выполнено в главной странице сайта: <a href="../index.php">index.php</a>
        собирается из файлов head.html и nav.html (через require), header.html и footer.html (через include).
    </p>

</body>

</html>
