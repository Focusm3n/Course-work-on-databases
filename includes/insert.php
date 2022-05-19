<?php
session_start();
if (!$_SESSION['user']) {
    header("Location: index-Course.php");
}
$name = $_POST['name'];
$author = $_POST['author'];
$page = $_POST['page'];
$genre = $_POST['genre'];
$year = $_POST['year'];
$public = $_POST['public'];
$description = $_POST['description'];

$connect = mysqli_connect('localhost', 'root', 'root', 'register-bd');
$book = mysqli_query($connect, "INSERT INTO book (name_book, author_fk, page_counts, genre_fk, year_of_creation, pub, description) VALUES ('$name', '$author', '$page', '$genre', '$year', '$public', '$description')");

if (!$public) {
    $b = mysqli_query($connect, "SELECT book.id FROM `book` WHERE name_book = '$name'");
    $id_book = mysqli_fetch_row($b);
    $id_user = $_SESSION['user']['id'];
    $book = mysqli_query($connect, "INSERT INTO request (client_fk, book_fk) VALUES ('$id_user', '$id_book[0]')");
}

mysqli_close($connect);
header('Location: ../library.php');

