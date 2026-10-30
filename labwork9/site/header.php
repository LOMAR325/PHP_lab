<?php
session_start();
require_once "lang.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["lang"]) && array_key_exists($_POST["lang"], $languages)) {
    $_SESSION["lang"] = $_POST["lang"];
    header("Location: " . $_SERVER["REQUEST_URI"]);
    exit;
}

$lang = $_SESSION["lang"] ?? "ru";
$t = $texts[$lang];
$page = basename($_SERVER["SCRIPT_NAME"], ".php");
?>
<html lang="<?= $lang ?>">

<head>
    <meta charset="utf-8">
    <title><?= $t["pages"][$page]["title"] ?> — <?= $t["site"] ?></title>
    <style>
        body {
            font-family: Georgia, "Times New Roman", serif;
            max-width: 640px;
            margin: 40px auto;
            padding: 0 24px;
            line-height: 1.5;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #1e1e1e;
            padding-bottom: 12px;
        }

        nav a {
            margin-right: 16px;
        }

        nav a.active {
            font-weight: bold;
            text-decoration: none;
            color: #1e1e1e;
        }

        footer {
            margin-top: 36px;
            font-size: 13px;
            color: #808080;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <?php foreach ($t["nav"] as $file => $title): ?>
                <a href="<?= $file ?>.php" class="<?= $file === $page ? "active" : "" ?>"><?= $title ?></a>
            <?php endforeach; ?>
        </nav>

        <form method="post">
            <label>
                <?= $t["choose"] ?>
                <select name="lang" onchange="this.form.submit()">
                    <?php foreach ($languages as $code => $name): ?>
                        <option value="<?= $code ?>" <?= $code === $lang ? "selected" : "" ?>><?= $name ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        </form>
    </header>
