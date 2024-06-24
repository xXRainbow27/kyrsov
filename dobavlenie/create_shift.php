<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: /auth/");
    exit;
}
include "inc/header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $datestart = $_POST['datestart'];
    $dateend = $_POST['dateend'];

    // Подключение к базе данных
    $connect = new mysqli("localhost", "root", "", "bd_novaya");
    if ($connect->connect_error) {
        die("Ошибка подключения к базе данных");
    }

    // SQL запрос для вставки данных в таблицу "shift"
    $sql = "INSERT INTO shift (datestart, dateend) VALUES ('$datestart', '$dateend')";
    
    if ($connect->query($sql) === TRUE) {
        echo "Смена успешно создана";
    } else {
        echo "Ошибка при создании смены: " . $connect->error;
    }

    $connect->close();
}
?>

<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='/style/main.css'>
</head>

<form method="post" action="shift.php">
    <label for="datestart">Дата начала смены:</label>
    <input type="date" id="datestart" name="datestart" required>

    <label for="dateend">Дата окончания смены:</label>
    <input type="date" id="dateend" name="dateend" required>

    <button type="submit">Создать смену</button>
</form> 