<?php
session_start();
require_once 'connect.php';
/**
 * @var connect $connect
 */

$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$password = md5(filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING));

$user_data = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
if (mysqli_num_rows($user_data) != 0) {
    $user = mysqli_fetch_assoc($user_data);
    if ($user['admin'] == 1)
    {
        $_SESSION['admin'] = [
            "id" => $user['id'],
            "name" => $user['name'],
            "avatar" => $user['avatar']
        ];
        header('Location: ../admin/index.php');
        die("404");
    }
    else
    {
        $_SESSION['user'] = [
            "id" => $user['id'],
            "name" => $user['name'],
            "avatar" => $user['avatar']
        ];
        header('Location: ../library.php');
        die("404");
    }
} else {
    $_SESSION['message_error'] = 'Неверный логин или пароль';
    header('Location: ../index-Course.php');
}

