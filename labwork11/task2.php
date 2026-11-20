<?php
require_once "db.php";

$errors = [];

if (isset($_POST["add_author"])) {
    $name = trim($_POST["name"]);
    $country = trim($_POST["country"]);

    if ($name === "" || $country === "") {
        $errors[] = "Заполните имя и страну автора";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO author (name, country) VALUES (?, ?)");
            $stmt->execute([$name, $country]);
            header("Location: task2.php?added=author");
            exit;
        } catch (PDOException $e) {
            $errors[] = "Ошибка базы данных: " . $e->getMessage();
        }
    }
}

if (isset($_POST["add_genre"])) {
    $title = trim($_POST["title"]);

    if ($title === "") {
        $errors[] = "Введите название жанра";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO genre (title) VALUES (?)");
            $stmt->execute([$title]);
            header("Location: task2.php?added=genre");
            exit;
        } catch (PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                $errors[] = "Жанр «" . $title . "» уже есть";
            } else {
                $errors[] = "Ошибка базы данных: " . $e->getMessage();
            }
        }
    }
}

if (isset($_POST["add_book"])) {
    $title = trim($_POST["book_title"]);
    $year = (int) $_POST["year"];
    $authorId = (int) $_POST["author_id"];
    $genreId = (int) $_POST["genre_id"];

    if ($title === "" || $year <= 0) {
        $errors[] = "Заполните название и год книги";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO book (title, year, author_id, genre_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$title, $year, $authorId, $genreId]);
            header("Location: task2.php?added=book");
            exit;
        } catch (PDOException $e) {
            if ($e->errorInfo[1] === 1452) {
                $errors[] = "Такого автора или жанра нет в базе";
            } else {
                $errors[] = "Ошибка базы данных: " . $e->getMessage();
            }
        }
    }
}

$authors = $pdo->query("SELECT id, name FROM author ORDER BY name")->fetchAll();
$genres = $pdo->query("SELECT id, title FROM genre ORDER BY title")->fetchAll();
?>
<html>

<head>
    <meta charset="utf-8">
    <title>ЛР11 — Задание 2</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <p><a href="lab11.php">К лабораторной</a></p>
    <h1>Задание 2. Добавление данных</h1>
    <p class="ok"><?= $dbMessage ?></p>

    <?php if (isset($_GET["added"])): ?>
        <p class="ok">
            Запись добавлена в таблицу <?= htmlspecialchars($_GET["added"]) ?>.
            <a href="task1.php">Посмотреть все таблицы</a>
        </p>
    <?php endif; ?>

    <?php foreach ($errors as $error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endforeach; ?>

    <form method="post">
        <fieldset>
            <legend>Новый автор</legend>
            <p><label>Имя</label> <input type="text" name="name" placeholder="Лев Толстой"></p>
            <p><label>Страна</label> <input type="text" name="country" placeholder="Россия"></p>
            <button type="submit" name="add_author">Добавить автора</button>
        </fieldset>
    </form>

    <form method="post">
        <fieldset>
            <legend>Новый жанр</legend>
            <p><label>Название</label> <input type="text" name="title" placeholder="Поэзия"></p>
            <button type="submit" name="add_genre">Добавить жанр</button>
        </fieldset>
    </form>

    <form method="post">
        <fieldset>
            <legend>Новая книга</legend>
            <p><label>Название</label> <input type="text" name="book_title" placeholder="Война и мир"></p>
            <p><label>Год</label> <input type="number" name="year" placeholder="1869"></p>
            <p>
                <label>Автор</label>
                <select name="author_id">
                    <?php foreach ($authors as $author): ?>
                        <option value="<?= $author["id"] ?>"><?= htmlspecialchars($author["name"]) ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p>
                <label>Жанр</label>
                <select name="genre_id">
                    <?php foreach ($genres as $genre): ?>
                        <option value="<?= $genre["id"] ?>"><?= htmlspecialchars($genre["title"]) ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <button type="submit" name="add_book">Добавить книгу</button>
        </fieldset>
    </form>
</body>

</html>
