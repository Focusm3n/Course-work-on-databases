<?php
session_start();
if (!$_SESSION['user']) {
    header("Location: index-Course.php");
}
$user = $_SESSION['user'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>О нас</title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>
<header>
    <div class="nav">
        <div>
            <a href="../library.php">Главная</a>
            <a href="about.php">О нас</a>
            <a href="contacts.php">Контакты</a>
        </div>
        <div class="header-img">
            <img src="<?= $_SESSION['user']['avatar'] ?>" width="35" alt="">
        </div>
        <div>
            <a href="#"><?= $_SESSION['user']['name'] ?></a>
            <a href="logout.php" class="logout">Выход</a>
        </div>
    </div>
</header>
<main>
    <div class="basic">
        <h1>
            Свои всегда найдут гыыыы)
        </h1>

    </div>
</main>
</body>
</html>