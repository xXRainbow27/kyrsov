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

// Get user data from the "user" table (using only userid)
$resultUsers = $connect->query("SELECT `userid` FROM `user`");

// Get shift data from the "shift" table
$resultShifts = $connect->query("SELECT `shiftid` FROM `shift`");
$shifts = [];
while ($row = $resultShifts->fetch_assoc()) {
    $shifts[] = $row;
}

include "inc/header.php";
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


<form method="POST" action="assign.php">
    <label for="userid">Работяга:</label>
    <select name="user_id" id="user_id">
        <?php
        if ($resultUsers->num_rows > 0) {
            while ($row = $resultUsers->fetch_assoc()) {
                // Only display the userid in the dropdown
                echo "<option value='" . $row['userid'] . "'>" . $row['userid'] . "</option>";
            }
        }
        ?>
    </select>

    <label for="shiftid">Смена:</label>
    <select name="shiftid" id="shiftid">
        <?php foreach ($shifts as $shift): ?>
            <option value="<?php echo $shift['shiftid']; ?>"><?php echo $shift['shiftid']; ?></option> 
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Подтвердить">
</form>

<?php
$connect->close();
?>