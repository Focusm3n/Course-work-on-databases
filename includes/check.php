<?php
$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

if (strlen($login) < 5 || strlen($login) > 90) {
    echo "Недопустимая длина логина";
    exit();
} else if (strlen($name) < 3 || strlen($name) > 40) {
    echo "Недопустимая длина имени";
    exit();
} else if (strlen($password) < 5 || strlen($password) > 90) {
    echo "Недопустимая длина пароля";
    exit();
}

$password = md5($password);

$mysql = new mysqli('localhost', 'root', 'root', 'register-bd');
$mysql->query("INSERT INTO `users` (`login`, `pass`, `name`) VALUES ('$login', '$password', '$name')");

$mysql->close();

header('Location:/');
