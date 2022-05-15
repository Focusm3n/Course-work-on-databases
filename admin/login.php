<!doctype html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>Логин</title>
</head>
<body>
<h1>Логин</h1>

<form action="login.php" method="post">
    <label for="login">Логин</label>
    <input type="text" name="login">
    <label for="password">Пароль</label>
    <input type="text" name="password">
    <input type="submit" value="login">
</form>

</body>
</html>

<?php
if($_POST) {
    $login = $_POST['login'];
    $password = $_POST['password'];


}
