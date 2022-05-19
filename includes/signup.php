<?php
session_start();
require_once 'connect.php';
/**
 * @var connect $connect
 */
$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
$password_confirm = filter_var(trim($_POST['password_confirm']));


if (strlen($name) < 3 || strlen($name) > 40) {
    $_SESSION['message_error'] = 'Недопустимая длина имени';
    header('Location: register.php');
    die("");
} else if (strlen($login) < 5 || strlen($login) > 90) {
    $_SESSION['message_error'] = 'Недопустимая длина логина';
    header('Location: register.php');
    die("");
} else {
    $login_check = mysqli_query($connect, "SELECT password FROM `users` WHERE `login` = '$login'");
    if (mysqli_num_rows($login_check) != 0) {
        $_SESSION['message_error'] = 'Такой пользователь уже существует. Авторизируйтесь';
        header('Location: ../index-Course.php');
        die("");
    }
}
  if (strlen($password) < 5 || strlen($password) > 90) {
    $_SESSION['message_error'] = 'Недопустимая длина пароля';
    header('Location: register.php');
      die("");
}
if ($password === $password_confirm) {
    //$_FILES['avatar']['name']
    if ($_FILES['avatar']['name']) {
        $path = 'uploads/' . time() . $_FILES['avatar']['name'];
        move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path);
    } else {
        $path = NULL;
    }
    $password = md5($password);
    mysqli_query($connect, "INSERT INTO `users` (`id`, `name`, `login`, `password`, `avatar`) VALUES (NULL, '$name', '$login', '$password', '$path')");

    $_SESSION['message_good'] = 'Регистрация прошла успешно';
    header('Location: ../index-Course.php');
    die("");

} else {
    $_SESSION['message_error'] = 'Пароли не совпадают';
    header('Location: register.php');
    die("");
}


