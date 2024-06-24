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

// SQL query to fetch users for the dropdown menu, excluding users with userroleid 1 and namerole "Заведующий подразделением"
$sqlUsers = "SELECT u.userid, CONCAT(u.firstname, ' ', u.lastname) AS full_name  
             FROM user u 
             JOIN userrole ur ON u.userroleid = ur.userroleid 
             WHERE ur.userroleid != 1 OR ur.namerole != 'Заведующий подразделением'";
$resultUsers = $connect->query($sqlUsers);
?>

<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='/style/main.css'>
</head>
<h2>Список всех пользователей:</h2>
<table>
    <tr>
        <th>ID Пользователя</th>
        <th>Логин</th>
        <th>Статус</th>
        <th>Фиолетов</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>ID Роли</th>
    </tr>
    <?php
    $sqlAllUsers = "SELECT * FROM user WHERE userroleid != 1";
    $resultAllUsers = $connect->query($sqlAllUsers);
    if ($resultAllUsers->num_rows > 0) {
        while ($row = $resultAllUsers->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['userid'] . "</td>";
            echo "<td>" . $row['login'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td>" . $row['lastname'] . "</td>";
            echo "<td>" . $row['firstname'] . "</td>";
            echo "<td>" . $row['middlename'] . "</td>";
            echo "<td>" . $row['userroleid'] . "</td>";
            echo "</tr>";
        }
    }
    ?>
</table>
<form method="post" action="emp.php">
    <button type="submit">Увольнение и добавление сотрудников</button>
</form>
<form method="post" action="shifts.php">
    <button type="submit">Смены</button>
</form>

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
        // Получаем заказы из таблицы "order"
        $resultOrders = $connect->query("SELECT * FROM `order`");

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