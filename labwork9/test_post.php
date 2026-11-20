<?php
session_start();
echo "<pre>";
echo "<p>Отлично ", $_GET["name"], " я тоже люблю ";
$s = $_GET;
foreach ($s as $key => $val) {
    if ($val && $key != "name") {
        echo $key, ", ";
    }
}
?>
<html>

<head>
    <title>Тестовое задание</title>
</head>

<body>
</body>

</html>