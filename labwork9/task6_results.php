<?php
session_start();

const SURVEY_ID = "survey_morning";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
    $number = (int) $_POST["delete"];
    unset($_SESSION[SURVEY_ID][$number]);
    header("Location: task6_results.php");
    exit;
}

$results = $_SESSION[SURVEY_ID] ?? [];
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Задание 6 — результаты опроса</title>
    <style>
        table {
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid #999;
            padding: 6px 10px;
            vertical-align: top;
        }

        .swatch {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 1px solid #999;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <h1>Задание 6 — результаты опроса «Утро студента»</h1>
    <p><a href="lab9.php">к лабораторной</a> | <a href="task6.php">пройти опрос</a></p>
    <hr>

    <?php if (count($results) === 0): ?>

        <p>Ответов пока нет — <a href="task6.php">пройдите опрос</a>.</p>

    <?php else: ?>

        <table>
            <tr>
                <th>№</th>
                <th>имя</th>
                <th>возраст</th>
                <th>подъём</th>
                <th>напиток</th>
                <th>завтрак</th>
                <th>транспорт</th>
                <th>настроение</th>
                <th>цвет</th>
                <th>комментарий</th>
                <th></th>
            </tr>
            <?php foreach ($results as $number => $answer): ?>
                <tr>
                    <td><?= $number ?></td>
                    <td><?= htmlspecialchars($answer["name"]) ?></td>
                    <td><?= $answer["age"] ?></td>
                    <td><?= htmlspecialchars($answer["wake_up"]) ?></td>
                    <td><?= htmlspecialchars($answer["drink"]) ?></td>
                    <td><?= htmlspecialchars(implode(", ", $answer["breakfast"])) ?: "—" ?></td>
                    <td><?= htmlspecialchars($answer["transport"]) ?></td>
                    <td><?= $answer["mood"] ?> / 10</td>
                    <td><span class="swatch" style="background: <?= htmlspecialchars($answer["colour"]) ?>"></span></td>
                    <td><?= htmlspecialchars($answer["comment"]) ?: "—" ?></td>
                    <td>
                        <form method="post">
                            <button type="submit" name="delete" value="<?= $number ?>">Удалить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h2>Так результаты лежат в $_SESSION["<?= SURVEY_ID ?>"]</h2>
        <pre><?= htmlspecialchars(print_r($results, true)) ?></pre>

    <?php endif; ?>

</body>

</html>
