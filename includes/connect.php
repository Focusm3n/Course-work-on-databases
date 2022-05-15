<?php
$connect = mysqli_connect('localhost', 'root', 'root', 'register-bd');
if (!$connect) {
    die('Error connect to DataBase');
}