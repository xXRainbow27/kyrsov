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

// Обработка формы для увольнения пользователя
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['user_id'])) {
        $userId = $_POST['user_id'];
        // Обновление статуса пользователя на "уволен"
        $sql = "UPDATE user SET status = 'уволен' WHERE userid = $userId";
        if ($connect->query($sql) === TRUE) {
            echo "Статус пользователя успешно обновлен.";
        } else {
            echo "Ошибка при обновлении статуса пользователя: " . $connect->error;
        }
    } else {
        echo "Пользователь не выбран для увольнения.";
    }
}

// SQL запрос для получения пользователей для выпадающего списка, исключая пользователей с userroleid 1 и namerole "Заведующий подразделением"
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

<form method="post">
    <label for="user_id">Выберите пользователя для увольнения:</label>
    <select name="user_id" id="user_id">
        <?php
        if ($resultUsers->num_rows > 0) {
            while ($row = $resultUsers->fetch_assoc()) {
                echo "<option value='" . $row['userid'] . "'>" . $row['full_name'] . "</option>";
            }
        }
        ?>
    </select>
    <button type="submit">Уволить</button>
</form>

<form method="post" action="addemp.php">
    <button type="submit">Добавление нового сотрудника</button>
</form>

<?php
$connect->close();
?>