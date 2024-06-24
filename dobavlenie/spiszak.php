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

// Получаем заказы из таблицы "order"
$resultOrders = $connect->query("SELECT * FROM `order`");

include "inc/header.php";
?>

<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='/style/main.css'>
</head>

<h2>Список заказов</h2>
<table border="1">
    <thead>
        <tr>
            <th>ID Заказа</th>
            <th>Дата создания</th>
            <th>Статус заказа</th>
            <th>Название конференции</th>
            <th>Кол-во гостей</th>
            <th>Оборудование</th>
            <th>Статус покупки</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($resultOrders->num_rows > 0) {
            while ($row = $resultOrders->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['orderid'] . "</td>";
                echo "<td>" . $row['datecreation'] . "</td>";
                echo "<td>" . $row['orderstatus'] . "</td>";
                echo "<td>" . $row['nameconference'] . "</td>";
                echo "<td>" . $row['amountguests'] . "</td>";
                echo "<td>" . $row['equipment'] . "</td>";
                echo "<td>" . $row['paymentstatus'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Заказы отсутствуют</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
$connect->close();
?>