<?php
session_start();
require_once 'includes/connect.php';
/**
 * @var connect $connect
 */
if (!$_SESSION['user']) {
    header("Location: index-Course.php");
}
$search_result = $_POST['query'];
if (!empty($_POST['query'])) {
    $search = mysqli_query($connect, "SELECT * FROM book WHERE name_book like '%$search_result%' ");
    $sear_res = mysqli_fetch_all($search);
}
$query = 'SELECT * FROM author';
$result = mysqli_query($connect, $query);
$authors = mysqli_fetch_all($result);

foreach ($authors as $key => $author)
{
    $query = 'SELECT * FROM book WHERE author_fk = '. $author[0];
    $result = mysqli_query($connect, $query);
    $books = mysqli_fetch_all($result);
    $authors[$key]['books'] = $books;
}
//print_r($authors[0]['books'][0]);
$books_data = mysqli_query($connect, "SELECT * FROM book WHERE pub = 1");
$user = $_SESSION['user'];
$books = mysqli_fetch_all($books_data);

?>
<!doctype html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>


    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<!-- Шапка -->
<header>
    <div class="nav">
        <div>
            <a href="library.php">Главная</a>
            <a href="includes/about.php">О нас</a>
            <a href="includes/contacts.php">Контакты</a>
        </div>
        <div class="header-img">
                <img src="<?= $_SESSION['user']['avatar'] ?>" width="35" alt="">
        </div>
        <div>
            <a href="includes/mylibrary.php" class="logout">Моя библиотка</a>
            <a href="admin/login.php"><?= $_SESSION['user']['name'] ?></a>
            <a href="includes/logout.php" class="logout">Выход</a>
        </div>
    </div>
</header>
<!-- Профиль -->
<main>

    <div class="basic">
        <h1>Книги на лето</h1>
        <form name="search" method="post" action="library.php">
            <input type="search" list="search" name="query" placeholder="Поиск">
            <datalist id="search">
                <?php foreach ($books as $key => $book) { ?>
                <option value="<?= $book[1] ?>">
                    <?php } ?>
            </datalist spellcheck="true">
            <button type="submit">Найти</button>
        </form>
        <?php
        if (!empty($_POST['query'])) {
            ?>
            <table>
                <table border="1"
                <tr>
                    <th>Название книги</th>
                    <th>Год издания</th>
                </tr>
                <?php foreach ($sear_res as $value) {?>
                    <tr>
                        <td><?= $value[1] ?></td>
                        <td><?= $value[5] ?></td>
                    </tr>
                <?php } ?>
            </table>
            <?php

        } else {
            ?>
            <table>
                <table border="1"
                <tr>
                    <th>Название книги</th>
                    <th>Год издания</th>
                </tr>
                <?php foreach ($books as $key => $book) { ?>
                    <tr>
                        <td><?php echo "<a href='includes/book.php?id=$book[0]'>$book[1] </a>"?></td>
                        <td><?= $book[5] ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
        <form action="includes/addBook.php" method="post" class="authorization">
            <input type="hidden" name="public" value="<?php echo "1" ?>">
            <button class="btn btn-success" type="submit">Добавить</button>
        </form>
    </div>
</main>
</body>
</html>

