<?php
// Задание 4: двухэтапная регистрация. Шаг 1 — GET, шаг 2 — POST.
session_start();

$errors = [];

// выход — чтобы можно было пройти регистрацию заново
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["logout"])) {
    unset($_SESSION["user"]);
    header("Location: task4.php");
    exit;
}

// шаг 2 отправлен
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
    $login = trim($_POST["login"]);
    $password = $_POST["password"] ?? "";
    $agree = isset($_POST["agree"]);

    if ($login === "") {
        $errors[] = "Введите логин";
    }
    if (strlen($password) < 6) {
        $errors[] = "Пароль должен быть не короче 6 символов";
    }
    if (!$agree) {
        $errors[] = "Нужно согласиться с правилами сайта";
    }

    if (count($errors) === 0) {
        $_SESSION["user"] = [
            "name" => $_POST["name"],
            "birth" => $_POST["birth"],
            "phone" => $_POST["phone"],
            "email" => $_POST["email"],
            "login" => $login,
            "password" => password_hash($password, PASSWORD_DEFAULT),   // пароль храним только в виде хеша
        ];
        session_regenerate_id(true);
        header("Location: task4.php");
        exit;
    }
}

// данные шага 1: пришли в $_GET (после шага 1) или в $_POST (если на шаге 2 были ошибки)
$step1 = $_SERVER["REQUEST_METHOD"] === "POST" ? $_POST : $_GET;
$name = trim($step1["name"] ?? "");

if (isset($_SESSION["user"])) {
    $view = "welcome_back";
} elseif ($name !== "") {
    $view = "step2";
} else {
    $view = "step1";
}

// htmlspecialchars — для всего, что ввёл пользователь и что выводится в HTML
function e(string $text): string
{
    return htmlspecialchars($text);
}
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Задание 4 — регистрация</title>
    <style>
        form p {
            margin: 10px 0;
        }

        label {
            display: inline-block;
            width: 140px;
        }

        .error {
            color: #b00020;
        }
    </style>
</head>

<body>
    <h1>Задание 4 — регистрация</h1>
    <p><a href="lab9.php">к лабораторной</a></p>
    <hr>

    <?php if ($view === "welcome_back"): ?>

        <h2>С возвращением, <?= e($_SESSION["user"]["login"]) ?>!</h2>

        <p>Данные из сессии ($_SESSION["user"]), пароль хранится в виде хеша:</p>
        <pre><?= e(print_r($_SESSION["user"], true)) ?></pre>

        <form method="post">
            <button type="submit" name="logout" value="1">Выйти и зарегистрироваться заново</button>
        </form>

    <?php elseif ($view === "step2"): ?>

        <h2>Шаг 2 из 2</h2>
        <p>Добро пожаловать, <?= e($name) ?>! Теперь придумайте логин и пароль</p>

        <?php foreach ($errors as $error): ?>
            <p class="error"><?= $error ?></p>
        <?php endforeach; ?>

        <form method="post" action="task4.php">
            <!-- данные шага 1 едут дальше в скрытых полях -->
            <input type="hidden" name="name" value="<?= e($name) ?>">
            <input type="hidden" name="birth" value="<?= e($step1["birth"] ?? "") ?>">
            <input type="hidden" name="phone" value="<?= e($step1["phone"] ?? "") ?>">
            <input type="hidden" name="email" value="<?= e($step1["email"] ?? "") ?>">

            <p><label>Логин</label> <input type="text" name="login" value="<?= e($_POST["login"] ?? "") ?>" required></p>
            <p><label>Пароль</label> <input type="password" name="password" required></p>
            <p><input type="checkbox" name="agree" id="agree"> <label for="agree" style="width: auto">Я согласен с правилами сайта</label></p>
            <p><button type="submit">Зарегистрироваться</button></p>
        </form>

    <?php else: ?>

        <h2>Шаг 1 из 2</h2>

        <form method="get" action="task4.php">
            <p><label>Имя</label> <input type="text" name="name" required></p>
            <p><label>Дата рождения</label> <input type="date" name="birth" required></p>
            <p><label>Телефон</label> <input type="tel" name="phone" placeholder="+375 29 123-45-67" required></p>
            <p><label>E-mail</label> <input type="email" name="email" required></p>
            <p><button type="submit">Далее</button></p>
        </form>

    <?php endif; ?>

</body>

</html>
