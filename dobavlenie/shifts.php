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
$sql = "SELECT `shiftid`, `datestart`, `dateend` FROM `shift`";
$result = mysqli_query($connect, $sql);

// Проверка наличия данных
if (mysqli_num_rows($result) > 0) {
    // Вывод данных в виде таблицы
    echo "<table border='1'>";
    echo "<tr><th>ID Смены</th><th>Дата начала</th><th>Дата окончания</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row['shiftid']."</td><td>".$row['datestart']."</td><td>".$row['dateend']."</td></tr>";
    }
    echo "</table>";
} else {
    echo "Нет доступных данных о сменах.";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $datestart = isset($_POST['datestart']) ? $_POST['datestart'] : "";
    $dateend = isset($_POST['dateend']) ? $_POST['dateend'] : "";

    // Check if datestart and dateend are not empty
    if (!empty($datestart) && !empty($dateend)) {
        // Proceed with database operations
        // ...
    } else {
        echo "Пожалуйста введите дату";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='/style/main.css'>
</head>

<form method="post" action="create_shift.php">
    <label for="datestart">Дата начала смены:</label>
    <input type="date" id="datestart" name="datestart" required>

    <label for="dateend">Дата окончания смены:</label>
    <input type="date" id="dateend" name="dateend" required>

    <button type="submit">Создать смену</button>
</form>
<form method="post" action="shiftnaz.php">
    <button type="submit">Назначение смены</button>
</form>