<?php require "header.php"; ?>

<h1><?= $t["pages"]["food"]["title"] ?></h1>

<?php foreach ($t["pages"]["food"]["text"] as $paragraph): ?>
    <p><?= $paragraph ?></p>
<?php endforeach; ?>

<?php require "footer.php"; ?>
