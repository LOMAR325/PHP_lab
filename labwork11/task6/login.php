<?php
session_start();
require_once "../db.php";

$error = "";
$email = "";

if (isset($_POST["enter"])) {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password . $user["salt"], $user["password_hash"])) {
        session_regenerate_id(true);           
        $_SESSION["user_id"] = $user["id"];   

        header("Location: profile.php");
        exit;
    }

    $error = "Неверная почта или пароль";
}
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Вход — Библиотека</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require "menu.php"; ?>

    <main>
        <h1>Вход</h1>

        <div class="box">
            <?php if ($error !== ""): ?>
                <p class="error"><?= $error ?></p>
            <?php endif; ?>

            <form method="post">
                E-mail
                <input type="text" name="email" value="<?= htmlspecialchars($email) ?>">
                Пароль
                <input type="password" name="password">
                <button type="submit" name="enter">Войти</button>
            </form>

            <p>Нет аккаунта? <a href="../task4.php">Зарегистрироваться</a></p>
            <p style="color: #666; font-size: 14px">Для проверки: student@example.com, пароль student123</p>
        </div>
    </main>
</body>

</html>
