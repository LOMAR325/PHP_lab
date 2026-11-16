<?php
session_start();
$method = $_SERVER["REQUEST_METHOD"];
if($method === "POST")
{
    $_SESSION["color"] = $color = $_POST["color"] ?? "";
    $_SESSION["name"] = $name = $_POST["name"] ?? "";
}
if($_SERVER["REQUEST_METHOD"] === "GET"){
    echo "метод GET";
}
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Пример $_POST</title>
</head>

<body>
    <h1>Пример $_POST</h1>

    <form method="post">

        <p>Имя: <input type="text" name="name"></p>

        <p>
            Любимый цвет:
            <select name="color">
                <option value="red">Красный</option>
                <option value="green">Зелёный</option>
                <option value="blue">Синий</option>
            </select>
        </p>

        <button type="submit">Отправить</button>
    </form>


    <hr>

    <p>Метод запроса: <b><?= $method ?></b></p>

    <?php if ($method === "POST"): ?>
        <?php else: ?>
            <p>Форму ещё не отправляли — $_POST пустой.</p>
            <?php endif; ?>
            
            <p>Привет, <?= $_SESSION["name"] ?>! Ты выбрал цвет: <b><?= $_SESSION["color"] ?></b></p>
    <a href="test_post.php?action=testin">кликни</a>
    <p>Всё, что лежит в $_POST:</p>
    <pre><?= htmlspecialchars(print_r($_SESSION, true)) ?></pre>

</body>

</html>
