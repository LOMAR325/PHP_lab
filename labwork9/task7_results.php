<?php
$query = trim($_GET["query"] ?? "");
$genre = $_GET["genre"] ?? "";
$format = $_GET["format"] ?? "";
$langs = (array) ($_GET["lang"] ?? []);   
$yearFrom = (int) ($_GET["year_from"] ?? 0);

$books = [
    ["title" => "Властелин колец", "author" => "Дж. Р. Р. Толкин", "genre" => "фэнтези", "format" => "бумажная", "lang" => "русский", "year" => 1954],
    ["title" => "The Hobbit", "author" => "J. R. R. Tolkien", "genre" => "фэнтези", "format" => "электронная", "lang" => "английский", "year" => 1937],
    ["title" => "Ведьмак", "author" => "А. Сапковский", "genre" => "фэнтези", "format" => "электронная", "lang" => "русский", "year" => 1993],
    ["title" => "Дюна", "author" => "Ф. Герберт", "genre" => "фантастика", "format" => "бумажная", "lang" => "русский", "year" => 1965],
    ["title" => "Foundation", "author" => "I. Asimov", "genre" => "фантастика", "format" => "бумажная", "lang" => "английский", "year" => 1951],
    ["title" => "Собака Баскервилей", "author" => "А. Конан Дойл", "genre" => "детектив", "format" => "электронная", "lang" => "русский", "year" => 1902],
    ["title" => "Новая зямля", "author" => "Я. Колас", "genre" => "классика", "format" => "бумажная", "lang" => "белорусский", "year" => 1923],
    ["title" => "Мастер и Маргарита", "author" => "М. Булгаков", "genre" => "классика", "format" => "бумажная", "lang" => "русский", "year" => 1967],
];

$found = array_filter($books, function ($book) use ($query, $genre, $format, $langs, $yearFrom) {
    if ($query !== "" && mb_stripos($book["title"] . " " . $book["author"], $query) === false) {
        return false;
    }
    if ($genre !== "" && $book["genre"] !== $genre) {
        return false;
    }
    if ($format !== "" && $book["format"] !== $format) {
        return false;
    }
    if (count($langs) > 0 && !in_array($book["lang"], $langs)) {
        return false;
    }
    if ($yearFrom > 0 && $book["year"] < $yearFrom) {
        return false;
    }
    return true;
});

$chosen = [
    "Название или автор" => $query,
    "Жанр" => $genre,
    "Формат" => $format,
    "Язык" => implode(", ", $langs),
    "Изданы не раньше" => $yearFrom > 0 ? "$yearFrom года" : "",
];
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Задание 7 — результаты поиска</title>
    <style>
        body {
            font-family: Georgia, "Times New Roman", serif;
        }

        .card {
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 12px 18px;
            background: #faf9f7;
        }

        .card td {
            padding: 4px 12px 4px 0;
        }

        .muted {
            color: #999;
        }

        code {
            background: #f2f2f2;
            padding: 2px 6px;
        }
    </style>
</head>

<body>
    <h1>Задание 7 — результаты поиска</h1>
    <p><a href="lab9.php">к лабораторной</a> | <a href="task7.php">изменить фильтр</a></p>
    <hr>

    <h2>Выбранные параметры</h2>

    <div class="card">
        <table>
            <?php foreach ($chosen as $label => $value): ?>
                <tr>
                    <td><b><?= $label ?></b></td>
                    <?php if ($value === ""): ?>
                        <td class="muted">не важно</td>
                    <?php else: ?>
                        <td><?= htmlspecialchars($value) ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <p>Строка запроса из адреса: <code>?<?= htmlspecialchars(urldecode($_SERVER["QUERY_STRING"] ?? "")) ?></code></p>

    <h2>Найдено книг: <?= count($found) ?></h2>

    <?php if (count($found) === 0): ?>
        <p class="muted">Ничего не найдено — попробуйте ослабить фильтр.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($found as $book): ?>
                <li>
                    <b><?= $book["title"] ?></b> — <?= $book["author"] ?>
                    <span class="muted">(<?= $book["genre"] ?>, <?= $book["format"] ?>, <?= $book["lang"] ?>, <?= $book["year"] ?>)</span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <h2>Содержимое $_GET</h2>
    <pre><?= htmlspecialchars(print_r($_GET, true)) ?></pre>

</body>

</html>
