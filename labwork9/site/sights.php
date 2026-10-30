<?php require "header.php"; ?>

<h1><?= $t["pages"]["sights"]["title"] ?></h1>

<ul>
    <?php foreach ($t["pages"]["sights"]["text"] as $item): ?>
        <li><?= $item ?></li>
    <?php endforeach; ?>
</ul>

<?php require "footer.php"; ?>
