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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $login = $_POST['login'];
    $password = $_POST['password'];
    $status = "активен"; // Default status for new employees
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $userroleid = $_POST['userroleid']; // You can set the default user role here

    // Insert the new employee data into the user table
    $sql = "INSERT INTO user (login, password, status, lastname, firstname, middlename, userroleid) 
            VALUES ('$login', '$password', '$status', '$lastname', '$firstname', '$middlename', '$userroleid')";

    if ($connect->query($sql) === TRUE) {
        echo "Новый сотрудник успешно зарегистрирован.";
    } else {
        echo "Ошибка при регистрации сотрудника: " . $connect->error;
    }
}

$connect->close();
?>

<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='/style/main.css'>
</head>

<h2>Регистрация нового сотрудника:</h2>
<form method="post">
    <label for="login">Логин:</label>
    <input type="text" name="login" required><br>
    <label for="password">Пароль:</label>
    <input type="password" name="password" required><br>
    <label for="lastname">Фамилия:</label>
    <input type="text" name="lastname" required><br>
    <label for="firstname">Имя:</label>
    <input type="text" name="firstname" required><br>
    <label for="middlename">Отчество:</label>
    <input type="text" name="middlename"><br>
    <label for="userroleid">ID Роли:</label>
    <input type="text" name="userroleid" value="2" required><br> <!-- Example: setting default user role ID -->
    <button type="submit" name="submit">Зарегистрировать</button>
</form>