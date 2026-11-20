<?php
require_once "db.php";

$errors = [];
$login = "";
$email = "";

if (isset($_POST["register"])) {
    $login = trim($_POST["login"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if ($login === "") {
        $errors[] = "Введите логин";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Некорректный e-mail";
    }
    if (mb_strlen($password) < 6) {
        $errors[] = "Пароль должен быть не короче 6 символов";
    }

    if (count($errors) === 0) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetchColumn() > 0) {
            $errors[] = "Пользователь с почтой $email уже зарегистрирован";
        }
    }

    if (count($errors) === 0) {
        $salt = bin2hex(random_bytes(16));                          
        $hash = password_hash($password . $salt, PASSWORD_DEFAULT); 

        $stmt = $pdo->prepare("INSERT INTO user (login, email, password_hash, salt) VALUES (?, ?, ?, ?)");
        $stmt->execute([$login, $email, $hash, $salt]);

        header("Location: task4.php?registered=" . $pdo->lastInsertId());
        exit;
    }
}

$newUser = false;
if (isset($_GET["registered"])) {
    $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->execute([$_GET["registered"]]);
    $newUser = $stmt->fetch();
}
?>
<html>

<head>
    <meta charset="utf-8">
    <title>ЛР11 — Задание 4</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <p><a href="lab11.php">К лабораторной</a></p>
    <h1>Задание 4. Регистрация</h1>
    <p class="ok"><?= $dbMessage ?></p>

    <?php if ($newUser): ?>
        <p class="ok">Пользователь <?= htmlspecialchars($newUser["login"]) ?> зарегистрирован.</p>
        <p>Так он записан в таблице user — вместо пароля хранятся хеш и соль:</p>
        <table>
            <?php foreach ($newUser as $column => $value): ?>
                <tr>
                    <th><?= $column ?></th>
                    <td><?= htmlspecialchars($value) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <?php foreach ($errors as $error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endforeach; ?>

    <form method="post">
        <p><label>Логин</label> <input type="text" name="login" value="<?= htmlspecialchars($login) ?>"></p>
        <p><label>E-mail</label> <input type="text" name="email" value="<?= htmlspecialchars($email) ?>"></p>
        <p><label>Пароль</label> <input type="password" name="password"></p>
        <button type="submit" name="register">Зарегистрироваться</button>
    </form>

    <p class="hint">Чтобы проверить занятую почту, введите student@example.com.</p>
</body>

</html>
