<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: /auth/");
    exit;
}

$connect = new mysqli("localhost", "root", "", "bd_novaya");
if ($connect->connect_error) {
    die("Ошибка подключения к базе данных");
}

include "inc/header.php";
?>

<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='/style/main.css'>
</head>

<form method="POST" action="create_order.php">
    <h2>Создание нового заказа</h2>
    <label for="nameconference">Название конференции:</label>
    <input type="text" name="nameconference" id="nameconference" required><br><br>

    <label for="amountguests">Количество гостей:</label>
    <input type="number" name="amountguests" id="amountguests" required><br><br>

    <label for="equipment">Оборудование:</label>
    <textarea name="equipment" id="equipment" required></textarea><br><br>

    <label for="datecreation">Дата проведения:</label>
    <input type="date" name="datecreation" id="datecreation" required><br><br> 

    <input type="submit" value="Создать заказ">
</form>

<?php
$connect->close();
?>
<form method="post" action="spiszak.php">
    <button type="submit">Список заказов</button>
</form>