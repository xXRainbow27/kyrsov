<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: /auth/");
    exit;
}
include "inc/header.php";


$connect = new mysqli("localhost", "root", "", "bd_novaya");
if ($connect->connect_error) {
    die("Ошибка подключения к базе данных");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_POST['user_id'];
    $shiftid = $_POST['shiftid'];

    // Проверка на наличие пользователя и смены
    $resultUser = $connect->query("SELECT userid FROM user WHERE userid = '$userid'");
    $resultShift = $connect->query("SELECT shiftid FROM shift WHERE shiftid = '$shiftid'");
    if ($resultUser->num_rows === 0 || $resultShift->num_rows === 0) {
        echo "Ошибка: Некорректные данные пользователя или смены.";
        exit;
    }

    // Вставка записи в таблицу "userlist"
    $sql = "INSERT INTO userlist (userid, shiftid) VALUES ('$userid', '$shiftid')";
    if ($connect->query($sql) === TRUE) {
        echo "Пользователь назначен на смену успешно!";
    } else {
        echo "Ошибка при назначении пользователя на смену: " . $connect->error;
    }
}

$connect->close();
?>

<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='/style/main.css'>
</head>