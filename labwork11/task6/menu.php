<nav>
    <a href="index.php" class="logo">Библиотека</a>
    <a href="index.php">Главная</a>

    <?php if (isset($_SESSION["user_id"])): ?>
        <a href="profile.php">Личный кабинет</a>
        <a href="logout.php">Выйти</a>
    <?php else: ?>
        <a href="login.php">Вход</a>
        <a href="../task4.php">Регистрация</a>
    <?php endif; ?>

    <a href="../lab11.php" class="back">К лабораторной</a>
</nav>
