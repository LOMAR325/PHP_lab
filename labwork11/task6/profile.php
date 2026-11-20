<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION["user_id"];
$errors = [];

$stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if (isset($_POST["save"])) {
    $login = trim($_POST["login"]);
    $email = trim($_POST["email"]);
    $newPassword = $_POST["new_password"];
    $password = $_POST["password"];   

    if (!password_verify($password . $user["salt"], $user["password_hash"])) {
        $errors[] = "Неверный текущий пароль — изменения не сохранены";
    }
    if ($login === "") {
        $errors[] = "Введите логин";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Некорректный e-mail";
    }
    if ($newPassword !== "" && mb_strlen($newPassword) < 6) {
        $errors[] = "Новый пароль должен быть не короче 6 символов";
    }

    if (count($errors) === 0) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE email = ? AND id != ?");
        $stmt->execute([$email, $id]);

        if ($stmt->fetchColumn() > 0) {
            $errors[] = "Почта $email уже занята";
        }
    }

    if (count($errors) === 0) {
        $stmt = $pdo->prepare("UPDATE user SET login = ?, email = ? WHERE id = ?");
        $stmt->execute([$login, $email, $id]);

        if ($newPassword !== "") {
            $salt = bin2hex(random_bytes(16));
            $hash = password_hash($newPassword . $salt, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("UPDATE user SET password_hash = ?, salt = ? WHERE id = ?");
            $stmt->execute([$hash, $salt, $id]);
        }

        header("Location: profile.php?saved=1");
        exit;
    }
}
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Личный кабинет — Библиотека</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require "menu.php"; ?>

    <main>
        <h1>Личный кабинет</h1>
        <p>Здравствуйте, <b><?= htmlspecialchars($user["login"]) ?></b>! Вы с нами с <?= $user["created_at"] ?>.</p>

        <div class="box">
            <?php if (isset($_GET["saved"])): ?>
                <p class="ok">Изменения сохранены</p>
            <?php endif; ?>

            <?php foreach ($errors as $error): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>

            <form method="post">
                Логин
                <input type="text" name="login" value="<?= htmlspecialchars($user["login"]) ?>">
                E-mail
                <input type="text" name="email" value="<?= htmlspecialchars($user["email"]) ?>">
                Новый пароль (пусто — не менять)
                <input type="password" name="new_password">
                <b>Текущий пароль</b> — нужен для сохранения
                <input type="password" name="password">
                <button type="submit" name="save">Сохранить</button>
            </form>
        </div>
    </main>
</body>

</html>
