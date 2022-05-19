<?php
session_start();
require_once 'connect.php';
/**
 * @var connect $connect
 */
if (!$_SESSION['user']) {
    header("Location: index-Course.php");
}
$user = $_SESSION['user'];
$query = "SELECT b.id, b.name_book, b.year_of_creation FROM request r JOIN book b ON b.id = r.book_fk JOIN users u on u.id = r.client_fk WHERE u.id = ".$user['id'];
$data = array(); // в этот массив запишем то, что выберем из базы
$books_data = mysqli_query($connect, $query);
$row = mysqli_fetch_row($books_data);
while($row = mysqli_fetch_row($books_data)){ // оформим каждую строку результата
    // как ассоциативный массив
    $data[] = $row; // допишем строку из выборки как новый элемент результирующего массива
}
$json = json_encode($data); // и отдаём как json
?>
<!doctype html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JSON</title>
    <link rel="stylesheet" href="../assets/css/main.css">
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
            <a href="#" class="logout">Моя библиотка</a>
            <a href="#"><?= $_SESSION['user']['name'] ?></a>
            <a href="logout.php" class="logout">Выход</a>
        </div>
    </div>
</header>
<main>
    <div class="basic">
        <p>
            <?= $json;?>
        </p>
    </div>
</main>
</body>
</html>

