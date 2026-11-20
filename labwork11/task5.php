<?php
require_once "db.php";

$errors = [];

if (isset($_POST["save"])) {
    $id = (int) $_POST["id"];
    $login = trim($_POST["login"]);
    $email = trim($_POST["email"]);

    if ($login === "") {
        $errors[] = "Введите логин";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Некорректный e-mail";
    }

    if (count($errors) === 0) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE email = ? AND id != ?");
        $stmt->execute([$email, $id]);

        if ($stmt->fetchColumn() > 0) {
            $errors[] = "Почта $email уже занята другим пользователем";
        }
    }

    if (count($errors) === 0) {
        $stmt = $pdo->prepare("UPDATE user SET login = ?, email = ? WHERE id = ?");
        $stmt->execute([$login, $email, $id]);

        header("Location: task5.php?id=$id&saved=1");
        exit;
    }
}

$users = $pdo->query("SELECT id, login FROM user ORDER BY id")->fetchAll();

$id = (int) ($_GET["id"] ?? $_POST["id"] ?? $users[0]["id"]);

$stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();
?>
<html>

<head>
    <meta charset="utf-8">
    <title>ЛР11 — Задание 5</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <p><a href="lab11.php">К лабораторной</a></p>
    <h1>Задание 5. Просмотр и изменение пользователя</h1>
    <p class="ok"><?= $dbMessage ?></p>

    <form method="get">
        <label>Пользователь</label>
        <select name="id" onchange="this.form.submit()">
            <?php foreach ($users as $u): ?>
                <option value="<?= $u["id"] ?>" <?= $u["id"] === $id ? "selected" : "" ?>>
                    <?= htmlspecialchars($u["login"]) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <?php if (isset($_GET["saved"])): ?>
        <p class="ok">Изменения сохранены</p>
    <?php endif; ?>

    <?php foreach ($errors as $error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endforeach; ?>

    <?php if (!$user): ?>
        <p class="error">Пользователь не найден</p>
    <?php else: ?>
        <h2>Информация</h2>
        <table>
            <tr><th>id</th><td><?= $user["id"] ?></td></tr>
            <tr><th>Логин</th><td><?= htmlspecialchars($user["login"]) ?></td></tr>
            <tr><th>E-mail</th><td><?= htmlspecialchars($user["email"]) ?></td></tr>
            <tr><th>Зарегистрирован</th><td><?= $user["created_at"] ?></td></tr>
        </table>

        <h2>Изменить</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?= $user["id"] ?>">
            <p><label>Логин</label> <input type="text" name="login" value="<?= htmlspecialchars($user["login"]) ?>"></p>
            <p><label>E-mail</label> <input type="text" name="email" value="<?= htmlspecialchars($user["email"]) ?>"></p>
            <button type="submit" name="save">Сохранить</button>
        </form>
    <?php endif; ?>
</body>

</html>
