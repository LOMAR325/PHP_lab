<?php
require_once "db.php";

$q = trim($_GET["q"] ?? "");
$books = [];

if ($q !== "") {
    $stmt = $pdo->prepare("
        SELECT book.title, book.year, author.name AS author, genre.title AS genre
        FROM book
        JOIN author ON book.author_id = author.id
        JOIN genre ON book.genre_id = genre.id
        WHERE book.title LIKE ?
        ORDER BY book.title
    ");

    $stmt->execute(["%" . $q . "%"]);
    $books = $stmt->fetchAll();
}
?>
<html>

<head>
    <meta charset="utf-8">
    <title>ЛР11 — Задание 3</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <p><a href="lab11.php">К лабораторной</a></p>
    <h1>Задание 3. Поиск по таблице book</h1>
    <p class="ok"><?= $dbMessage ?></p>

    <form method="get">
        <input type="text" name="q" value="<?= htmlspecialchars($q) ?>" placeholder="часть названия, например: кол">
        <button type="submit">Найти</button>
    </form>

    <?php if ($q === ""): ?>
        <p>Введите часть названия книги.</p>
    <?php elseif (count($books) === 0): ?>
        <p>По запросу «<?= htmlspecialchars($q) ?>» ничего не найдено.</p>
    <?php else: ?>
        <p>По запросу «<?= htmlspecialchars($q) ?>» найдено книг: <?= count($books) ?></p>
        <table>
            <tr>
                <th>Название</th>
                <th>Год</th>
                <th>Автор</th>
                <th>Жанр</th>
            </tr>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= htmlspecialchars($book["title"]) ?></td>
                    <td><?= $book["year"] ?></td>
                    <td><?= htmlspecialchars($book["author"]) ?></td>
                    <td><?= htmlspecialchars($book["genre"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <p class="hint">
        Проверка защиты от SQL-инъекции: введите <code>' OR '1'='1</code> —
        с подготовленным запросом это просто текст, и книг с таким названием нет.
    </p>
</body>

</html>
