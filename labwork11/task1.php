<?php
require_once "db.php";

$tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
?>
<html>

<head>
    <meta charset="utf-8">
    <title>ЛР11 — Задание 1</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <p><a href="lab11.php">К лабораторной</a></p>
    <h1>Задание 1. Содержимое всех таблиц</h1>
    <p class="ok"><?= $dbMessage ?></p>

    <?php foreach ($tables as $table): ?>
        <?php
        $rows = $pdo->query("SELECT * FROM $table")->fetchAll();
        ?>

        <h2>Таблица <?= $table ?> (записей: <?= count($rows) ?>)</h2>

        <?php if (count($rows) === 0): ?>
            <p>Таблица пустая</p>
        <?php else: ?>
            <table>
                <tr>
                    <?php foreach (array_keys($rows[0]) as $column): ?>
                        <th><?= $column ?></th>
                    <?php endforeach; ?>
                </tr>

                <?php foreach ($rows as $row): ?>
                    <tr>
                        <?php foreach ($row as $value): ?>
                            <td><?= htmlspecialchars($value ?? "NULL") ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    <?php endforeach; ?>
</body>

</html>
