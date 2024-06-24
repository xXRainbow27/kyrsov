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
    $nameconference = $_POST['nameconference'];
    $amountguests = $_POST['amountguests'];
    $equipment = $_POST['equipment'];
    $datecreation = $_POST['datecreation']; // Get the date from the form

    // Вставка записи в таблицу "order"
    $sql = "INSERT INTO `order` (`nameconference`, `amountguests`, `equipment`, `datecreation`) VALUES ('$nameconference', '$amountguests', '$equipment', '$datecreation')";
    if ($connect->query($sql) === TRUE) {
        echo "Заказ успешно создан!";
    } else {
        echo "Ошибка при создании заказа: " . $connect->error;
    }
}

$connect->close();
?>

<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='/style/main.css'>
</head>