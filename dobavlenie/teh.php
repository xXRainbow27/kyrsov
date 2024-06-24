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

<h2>Обновление статуса</h2>
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

                // Order Status Dropdown
                echo "<td><form method='POST' action='update_order.php'>";
                echo "<select name='orderstatus' id='orderstatus'>";
                echo "<option value='готов' " . ($row['orderstatus'] === 'готов' ? 'selected' : '') . ">Готов</option>";
                echo "<option value='готовится' " . ($row['orderstatus'] === 'готовится' ? 'selected' : '') . ">Готовится</option>";
                echo "<option value='отменён' " . ($row['orderstatus'] === 'отменён' ? 'selected' : '') . ">Отменён</option>";
                echo "</select>";
                echo "<input type='hidden' name='orderid' value='" . $row['orderid'] . "'>";
                echo "<input type='submit' value='Обновить'>";
                echo "</form></td>";

                echo "<td>" . $row['nameconference'] . "</td>";
                echo "<td>" . $row['amountguests'] . "</td>";
                echo "<td>" . $row['equipment'] . "</td>";

                // Payment Status Dropdown
                echo "<td><form method='POST' action='update_order.php'>";
                echo "<select name='paymentstatus' id='paymentstatus'>";
                echo "<option value='принят' " . ($row['paymentstatus'] === 'принят' ? 'selected' : '') . ">Принят</option>";
                echo "<option value='оплачен' " . ($row['paymentstatus'] === 'оплачен' ? 'selected' : '') . ">Оплачен</option>";
                echo "<option value='не оплачен' " . ($row['paymentstatus'] === 'не оплачен' ? 'selected' : '') . ">Не оплачен</option>";
                echo "<option value='не принят' " . ($row['paymentstatus'] === 'не принят' ? 'selected' : '') . ">Не принят</option>";
                echo "</select>";
                echo "<input type='hidden' name='orderid' value='" . $row['orderid'] . "'>";
                echo "<input type='submit' value='Обновить'>";
                echo "</form></td>";
                
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Заказы отсутствуют</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
$connect->close();
?>