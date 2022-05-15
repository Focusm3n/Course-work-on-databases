<?php
session_start();
require_once 'connect.php';
/**
 * @var connect $connect
 */
if (!$_SESSION['user']) {
    header("Location: index.php");
}
//$search_result = $_POST['query'];
//if (!empty($_POST['query'])) {
//    $search = mysqli_query($connect, "SELECT * FROM book WHERE name_book like '%$search_result%' ");
//    $sear_res = mysqli_fetch_all($search);
//}
$user = $_SESSION['user'];
$query = "SELECT b.id, b.name_book, b.year_of_creation FROM request r JOIN book b ON b.id = r.book_fk JOIN users u on u.id = r.client_fk WHERE u.id = ".$user['id'];
$books_data = mysqli_query($connect, $query);
$books = mysqli_fetch_all($books_data);

?>
<!doctype html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    <title>Моя библиотка</title>


    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>
<!-- Шапка -->
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
        <form action="generatePDF.php" method="post">

            <button class="btn btn-success" type="submit">Генерировать PDF из MySQL</button>
        </form>
        <form action="generateJSON.php" method="post">
            <input type="hidden" name="JSON" value="<?php echo $json?>">
            <button class="btn btn-success" type="submit">Генерировать JSON файл</button>
        </form>


        <h1>Моя библиотка</h1>
            <table>
                <table border="1"
                <tr>
                    <th>Название книги</th>
                    <th>Год издания</th>
                </tr>
                <?php foreach ($books as $key => $book) { ?>
                    <tr>
                        <td><?php echo "<a href='book.php?id=$book[0]'>$book[1] </a>"?></td>
                        <td><?= $book[2] ?></td>
                    </tr>
                <?php } ?>
            </table>
        <form action="addBook.php" method="post" class="authorization">
            <input type="hidden" name="public" value="<?php echo "0" ?>">
            <button class="btn btn-success" type="submit">Добавить</button>
        </form>
    </div>
</main>
</body>
</html>



