<?php
session_start();

const SURVEY_ID = "survey_morning";   

$saved = false;

if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["survey_id"] ?? "") === SURVEY_ID) {
    $answer = [
        "name" => trim($_POST["name"] ?? ""),
        "age" => (int) ($_POST["age"] ?? 0),
        "wake_up" => $_POST["wake_up"] ?? "",
        "drink" => $_POST["drink"] ?? "",
        "breakfast" => $_POST["breakfast"] ?? [],  
        "transport" => $_POST["transport"] ?? "",
        "mood" => (int) ($_POST["mood"] ?? 5),
        "colour" => $_POST["colour"] ?? "#000000",
        "comment" => trim($_POST["comment"] ?? ""),
    ];

    $results = $_SESSION[SURVEY_ID] ?? [];

    $nextNumber = count($results) === 0 ? 1 : max(array_keys($results)) + 1;
    $results[$nextNumber] = $answer;

    $_SESSION[SURVEY_ID] = $results;

    header("Location: task6.php?saved=$nextNumber");
    exit;
}

$savedNumber = $_GET["saved"] ?? null;
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Задание 6 — опрос</title>
    <style>
        fieldset {
            margin-bottom: 12px;
        }

        .label {
            display: inline-block;
            width: 220px;
        }

        .ok {
            color: #1e7d32;
        }
    </style>
</head>

<body>
    <h1>Задание 6 — опрос «Утро студента»</h1>
    <p><a href="lab9.php">к лабораторной</a> | <a href="task6_results.php">результаты опроса</a></p>
    <hr>

    <?php if ($savedNumber !== null): ?>
        <p class="ok">Ответ № <?= htmlspecialchars($savedNumber) ?> сохранён. Можно пройти опрос ещё раз.</p>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="survey_id" value="<?= SURVEY_ID ?>">

        <fieldset>
            <legend>О вас</legend>
            <p><span class="label">Имя (text)</span> <input type="text" name="name" required></p>
            <p><span class="label">Возраст (number)</span> <input type="number" name="age" min="14" max="99" value="19"></p>
        </fieldset>

        <fieldset>
            <legend>Утро</legend>
            <p><span class="label">Во сколько встаёте (time)</span> <input type="time" name="wake_up" value="07:30"></p>

            <p><span class="label">Что пьёте утром (radio)</span>
                <label><input type="radio" name="drink" value="кофе" checked> кофе</label>
                <label><input type="radio" name="drink" value="чай"> чай</label>
                <label><input type="radio" name="drink" value="вода"> вода</label>
                <label><input type="radio" name="drink" value="ничего"> ничего</label>
            </p>

            <p><span class="label">Что едите на завтрак (checkbox)</span>
                <label><input type="checkbox" name="breakfast[]" value="каша"> каша</label>
                <label><input type="checkbox" name="breakfast[]" value="бутерброды"> бутерброды</label>
                <label><input type="checkbox" name="breakfast[]" value="яичница"> яичница</label>
                <label><input type="checkbox" name="breakfast[]" value="сырники"> сырники</label>
            </p>

            <p><span class="label">Как добираетесь (select)</span>
                <select name="transport">
                    <option value="пешком">пешком</option>
                    <option value="метро">метро</option>
                    <option value="автобус">автобус</option>
                    <option value="машина">машина</option>
                    <option value="велосипед">велосипед</option>
                </select>
            </p>

            <p><span class="label">Настроение утром, 1–10 (range)</span> <input type="range" name="mood" min="1" max="10" value="5"></p>
            <p><span class="label">Цвет вашего утра (color)</span> <input type="color" name="colour" value="#f5c542"></p>
        </fieldset>

        <fieldset>
            <legend>Комментарий (textarea)</legend>
            <textarea name="comment" rows="3" cols="50" placeholder="Что помогает проснуться?"></textarea>
        </fieldset>

        <button type="submit">Сохранить</button>
    </form>

</body>

</html>
