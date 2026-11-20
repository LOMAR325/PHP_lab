<?php
session_start();
?>
<html>

<head>
    <title>Тестовое задание</title>
</head>

<body>

    <pre>

    <form method="GET" action="test_post.php">
        <Label>Введите имя</Label>
        <input type="text" name="name">
        
        <label for="">Я люблю: </label>

        <input type="checkbox" name="php" id="php">
        <label for="php">PHP</label>

        <input type="checkbox" name="C++" id="c++">
        <label for="c++">c++</label>

        <input type="checkbox" name="C#" id="C#">
        <label for="C#">C#</label>

        <input type="checkbox" name="html" id="html">
        <label for="html">html</label>

        <button type="submit">Перейти к пункту 2</button>
    </form>
</pre>
</body>

</html>