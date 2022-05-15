<?php
session_start();
if ($_SESSION['admin']) {
    ?>
    <!doctype html>
    <html lang="RU">
    <head>
        <meta charset="UTF-8">
        <title>Админка</title>

        <link rel="stylesheet" href="../assets/css/main.css">
    </head>
    <body>

    <main>
        <div class="basic">
            <h1>Вы админ</h1>
        </div>
    </main>
    </body>
    </html>
    <?php
}
?>

