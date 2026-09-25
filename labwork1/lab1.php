<html>

<head>
    <meta charset="utf-8">
    <title>Лабораторная работа №1</title>
</head>

<body>
    <h1>Лабораторная работа №1</h1>
    <hr>

    <?php echo "Это стандартный тег PHP" ?>

    <br><br>

    <?= "Такое используется чуть реже" ?>

    <? echo "Такое работает, если включена директива short_open_tag в конфигурации php.ini" ?>

    <?php
    echo "Меня видно";
    // А меня не видно
    ?>

    <?php
    echo "Меня видно";
    /* А меня не видно
Всё ещё не видно */
    ?>

    <?php
    echo "Меня видно"; # А меня нет
    ?>
    <p>Меня <?php # echo "не"; ?> видно</p>

    <?php
$message = "Я переменная message";
echo $message;?>

</body>

</html>