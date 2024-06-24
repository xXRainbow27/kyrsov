<?php
session_start();
include '../../function/connect.php';

$sql = "SELECT * FROM user WHERE login = :login AND password = :password";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':login', $_POST['login']);
$stmt->bindParam(':password', $_POST['password']);
$stmt->execute();

if($stmt->rowCount() > 0){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['login'] = $row['login'];
    $_SESSION['role'] = $row['role'];
    header("Location: /profile/");
    exit;
} else {
    header("Location: /vhod/index.php?message=Некорректный логин или пароль");
    exit;
}
