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
    $orderid = $_POST['orderid'];
    $orderstatus = $_POST['orderstatus'];
    $paymentstatus = $_POST['paymentstatus'];

    // Update order status
    $sql = "UPDATE `order` SET `orderstatus` = '$orderstatus' WHERE `orderid` = '$orderid'";
    if ($connect->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Статус заказа успешно обновлен!";
    } else {
        $_SESSION['error_message'] = "Ошибка обновления статуса заказа: " . $connect->error;
    }

    // Update payment status
    $sql = "UPDATE `order` SET `paymentstatus` = '$paymentstatus' WHERE `orderid` = '$orderid'";
    if ($connect->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Статус оплаты успешно обновлен!";
    } else {
        $_SESSION['error_message'] = "Ошибка обновления статуса оплаты: " . $connect->error;
    }

    header("Location: ../update_order.php"); // Redirect back to the order list
    exit;
}

$connect->close();
?>
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='/style/main.css'>
</head>