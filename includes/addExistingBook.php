<?php
session_start();
if (!$_SESSION['user']) {
    header("Location: index.php");
}
$id_user = $_POST['id_user'];

$connect = mysqli_connect('localhost', 'root', 'root', 'register-bd');
$book = mysqli_query($connect, "INSERT INTO request (client_fk, book_fk) VALUES ('$id_user', '$id_book')");


mysqli_close($connect);
header('Location: ../includes/mylibrary.php');

