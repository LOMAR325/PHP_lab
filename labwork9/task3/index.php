<?php require "header.php"; ?>

<h1><?= $t["pages"]["index"]["title"] ?></h1>

<?php foreach ($t["pages"]["index"]["text"] as $paragraph): ?>
    <p><?= $paragraph ?></p>
<?php endforeach; ?>

<?php require "footer.php"; ?>
