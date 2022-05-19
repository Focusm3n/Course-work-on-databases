<?php
session_start();
if (!$_SESSION['user']) {
    header("Location: index-Course.php");
}
$user = $_SESSION['user'];

$connect = mysqli_connect('localhost', 'root', 'root', 'register-bd');
$query = 'SELECT * FROM author';
$result = mysqli_query($connect, $query);
$authors = mysqli_fetch_all($result);

$query = 'SELECT * FROM genre';
$result = mysqli_query($connect, $query);
$genres = mysqli_fetch_all($result);

$public = $_POST['public'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавление книги</title>
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
            <a href="mylibrary.php" class="logout">Моя библиотка</a>
            <a href="#"><?= $_SESSION['user']['name'] ?></a>
            <a href="logout.php" class="logout">Выход</a>
        </div>
    </div>
</header>
<main>
    <form action="insert.php" method="post" class="basic">
        <h1>Добавление книги</h1><br>
        <label>Название книги<label class="star">*</label></label>
        <input type="text" name="name" placeholder="Введите название книги">
        <label for="author">Автор<label class="star">*</label></label>
        <select name="author">
            <?php
            foreach ($authors as $key => $author)
            {
                echo "<option value='$author[0]'>$author[1]</option>";
            }
            ?>
        </select>
        <label>Количество страниц<label class="star">*</label></label>
        <input type="text" name="page" placeholder="Введите кол-во страниц">
        <label for="genre">Жанр<label class="star">*</label></label>
        <select name="genre">
            <?php
            foreach ($genres as $key => $genre)
            {
                echo "<option value='$genre[0]'>$genre[1]</option>";
            }
            ?>
        </select>
        <label>Год создания<label class="star">*</label></label>
        <input type="text" name="year" placeholder="Введите год">
        <input type="hidden" name="public" value="<?php echo "$public" ?>">
        <label>Описание<label class="star">*</label></label>
        <input type="text" name="description" placeholder="Введите описание">
        <button type="submit">Добавить книгу</button>
    </form>
</main>
</body>
</html>