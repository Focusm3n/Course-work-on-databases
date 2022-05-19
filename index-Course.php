<?php
session_start();
if ($_SESSION['user']) {
    header("Location: library.php");
}
?>
<!doctype html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>

    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<main>
<!-- Форма авторизации -->
<form action="includes/signin.php" method="post" class="basic">
    <h1>Авторизация</h1><br>
    <label>Логин</label>
    <input type="text"  name="login" placeholder="Введите логин">
    <label>Пароль</label>
    <input type="password" name="password" placeholder="Введите пароль">
    <button type="submit">Войти</button>
    <p>
        У вас нет аккаунта? - <a href="/includes/register.php">Зарегистрироваться </a>
    </p>
    <?php
    if ($_SESSION['message_error']) {
        echo '<p class="msg_error">' . $_SESSION['message_error'] . '</p>';
        unset($_SESSION['message_error']);
        unset($_SESSION['message_good']);
    } else {
        if ($_SESSION['message_good']) {
            echo '<p class="msg_good">' . $_SESSION['message_good'] . '</p>';
            unset($_SESSION['message_good']);
        }
    }
    ?>
</form>
</main>
</body>
</html>

