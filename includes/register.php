<?php
session_start();
if ($_SESSION['user']) {
    header("Location: ../library.php");
}
?>
<!doctype html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>


    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>
<main>
<!-- Форма регистрации -->
<form action="signup.php" method="post" enctype="multipart/form-data" class="basic">
    <h1>Регистрация</h1><br>
    <label>Имя<label class="star">*</label></label>
    <input type="text" name="name" placeholder="Введите полное имя">
    <label>Изображение профиля</label>
    <input type="file" name="avatar">
    <label>Логин<label class="star">*</label></label>
    <input type="text" name="login" placeholder="Введите логин">
    <label>Пароль<label class="star">*</label></label>
    <input type="password" name="password" placeholder="Введите пароль">
    <input type="password" name="password_confirm" placeholder="Подтверждение пароля">
    <button type="submit">Зарегистрироваться</button>
    <p>
        У вас есть аккаунт? - <a href="../index.php">Войти</a>
    </p>
    <?php
    if ($_SESSION['message_error']) {
        echo '<p class="msg_error">' . $_SESSION['message_error'] . '</p>';
        unset($_SESSION['message_error']);
    }
    ?>
</form>
</main>
</body>
</html>