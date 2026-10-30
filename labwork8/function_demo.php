<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <?php
    echo show();
    echo show2();

    function show() {
        echo "Меня где-то вызвали";
    }

    $a = true;

    if ($a) {
        function show2() {
            echo "Меня тоже где-то вызвали?";
        }
    }
    ?>
</body>

</html>
