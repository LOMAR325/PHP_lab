<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <?php
    // Часть 2, задание 1 (# 4)
    // Вынесено в отдельный файл: require несуществующего файла останавливает скрипт,
    // и если бы этот код стоял в lab7.php, страница оборвалась бы на этом месте.
    // Файл nothing.php специально НЕ создан.
    include 'nothing.php';
    echo 'После include';
    require 'nothing.php';
    echo 'После require';
    ?>
</body>

</html>
