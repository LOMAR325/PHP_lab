<?php
$action = $_GET["action"] ?? "";
$message = "session_start() не вызывался";

if ($action === "start") {
    session_start();
    $_SESSION["opened_at"] = date("H:i:s");
    $message = "сессия открыта, id: " . session_id();
} elseif ($action === "destroy") {
    session_start();
    $_SESSION = [];
    session_destroy();
    $message = "session_destroy() — сессия удалена, кука осталась";
} elseif ($action === "delete_cookie") {
    session_start();
    $_SESSION = [];
    $params = session_get_cookie_params();
    setcookie(session_name(), "", time() - 3600, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    session_destroy();
    $message = "сессия удалена, кука удалена";
}
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Задание 1 — куки и сессия</title>
</head>

<body>
    <h1>Задание 1 — куки и сессия</h1>
    <p><a href="lab9.php"> к лабораторной</a></p>
    <hr>
    <p>
        <a href="task1.php?action=start">Открыть сессию</a> |
        <a href="task1.php?action=destroy">Завершить сессию (только session_destroy)</a> |
        <a href="task1.php?action=delete_cookie">Завершить сессию и удалить куку</a> |
        <a href="task1.php">Обновить без действий</a>
    </p>

    <?php
    echo "<pre>";
    echo "действие:        ", $action === "" ? "нет" : $action, "\n";
    echo "результат:       $message\n";
    echo "имя сессии:      ", session_name(), "\n\n";
    
    echo "куки, которые браузер прислал в этом запросе (\$_COOKIE):\n";
    print_r($_COOKIE);
    
    echo "</pre>";
    ?>

</body>

</html>