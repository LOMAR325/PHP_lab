<?php
session_start();
require_once "../db.php";

$books = $pdo->query("
    SELECT book.title, book.year, author.name AS author, genre.title AS genre
    FROM book
    JOIN author ON book.author_id = author.id
    JOIN genre ON book.genre_id = genre.id
    ORDER BY book.title
")->fetchAll();
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Библиотека</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require "menu.php"; ?>

    <main>
        <h1>Каталог книг</h1>
        <p>Книг в библиотеке: <?= count($books) ?></p>

        <div class="cards">
            <?php foreach ($books as $book): ?>
                <div class="card">
                    <span class="genre"><?= htmlspecialchars($book["genre"]) ?></span>
                    <h3><?= htmlspecialchars($book["title"]) ?></h3>
                    <p><?= htmlspecialchars($book["author"]) ?>, <?= $book["year"] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>

</html>
