<?php
session_start();

$current = [
    "host" => $_SERVER["SERVER_NAME"] ?? "нет данных",
    "ip" => $_SERVER["SERVER_ADDR"] ?? "нет данных",
    "protocol" => $_SERVER["SERVER_PROTOCOL"] ?? "нет данных",
    "port" => (string) ($_SERVER["SERVER_PORT"] ?? "нет данных"),
    "script" => $_SERVER["SCRIPT_NAME"] ?? "нет данных",
];

$fromCookie = [];
foreach ($current as $key => $value) {
    $fromCookie[$key] = $_COOKIE["server_" . $key] ?? null;
}
$fromSession = $_SESSION["server"] ?? [];

foreach ($current as $key => $value) {
    setcookie("server_" . $key, $value, time() + 60 * 60 * 24);  
}
$_SESSION["server"] = $current;

$labels = [
    "host" => "имя хоста",
    "ip" => "IP-адрес",
    "protocol" => "протокол",
    "port" => "порт",
    "script" => "имя скрипта",
];

function compare(?string $saved, string $now): string
{
    if ($saved === null) {
        return "<td class='empty'>нет</td>";
    }
    $class = $saved === $now ? "same" : "diff";
    $mark = $saved === $now ? "✓ совпадает" : "✗ отличается";
    return "<td class='$class'>" . htmlspecialchars($saved) . "<br><small>$mark</small></td>";
}
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Задание 5 — $_SERVER, куки и сессия</title>
    <style>
        td,
        th {
            border: 1px solid #999;
            padding: 6px 10px;
            vertical-align: top;
        }

        table {
            border-collapse: collapse;
        }

        .same {
            background: #e6f4ea;
        }

        .diff {
            background: #fde7e9;
        }

        .empty {
            color: #999;
        }
    </style>
</head>

<body>
    <h1>Задание 5 — $_SERVER, куки и сессия</h1>
    <p><a href="lab9.php">к лабораторной</a></p>
    <hr>

    <p>Файл: <b><?= htmlspecialchars(basename($_SERVER["SCRIPT_NAME"])) ?></b>, id сессии: <?= session_id() ?></p>

    <table>
        <tr>
            <th>параметр</th>
            <th>сейчас ($_SERVER)</th>
            <th>сохранено в куке</th>
            <th>сохранено в сессии</th>
        </tr>
        <?php foreach ($current as $key => $now): ?>
            <tr>
                <td><?= $labels[$key] ?></td>
                <td><?= htmlspecialchars($now) ?></td>
                <?= compare($fromCookie[$key], $now) ?>
                <?= compare($fromSession[$key] ?? null, $now) ?>
            </tr>
        <?php endforeach; ?>
    </table>

    <p>«нет» — значение ещё не сохранялось (или сохранённое пропало). Обновите страницу — появится сохранённое.</p>

    <h2>Эксперименты</h2>
    <ol>
        <li>Обновите страницу: в обоих столбцах всё совпадает.</li>
        <li>Полностью закройте браузер (Cmd + Q), откройте снова и зайдите на эту страницу.</li>
        <li>Переименуйте этот файл (например, в task5_renamed.php), откройте его по новому адресу.</li>
    </ol>

</body>

</html>
