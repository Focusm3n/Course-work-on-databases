<?php
session_start();
require_once 'connect.php';
/**
 * @var connect $connect
 */
if (!$_SESSION['user']) {
    header("Location: index.php");
}
$id_book = $_GET['id'];
$query = 'SELECT * FROM book WHERE id = '.$id_book;
$result = mysqli_query($connect, $query);
$book = mysqli_fetch_row($result);

$id_user = $_SESSION['user']['id'];

?>
<!doctype html>
<html lang="RU">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="../assets/css/main.css">
    <title><?php echo "$book[1]"?></title>
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
            <?php echo "$book[1]"?>
        </h1>
        <p>
            <?php echo "$book[7]"?>
        </p>
        <form action="addExistingBook.php" method="post" class="authorization">
            <input type="hidden" name="id_book" value="<?php echo "$id_book" ?>">
            <input type="hidden" name="id_user" value="<?php echo "$id_user" ?>">
            <button class="btn btn-success" type="submit">Добавить в библиотеку</button>
        </form>
    </div>
</main>
</body>
</html>
