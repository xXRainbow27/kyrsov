<?php
session_start();
include '../../function/connect.php';

$stmt = $pdo->prepare("SELECT login FROM user WHERE login = :login");
$stmt->bindParam(':login', $_POST['login']);
$stmt->execute();

if($stmt->rowCount() > 0){
    header("Location: /registration/index.php?message=Пользователь с таким логином уже существует");
    exit;
} else {
    $stmt = $pdo->prepare("INSERT INTO user(surname, name, patronymic, login, email, phone, password, role) VALUES(:surname, :name, :patronymic, :login, :email, :phone, :password, 'Пользователь')");
    $stmt->bindParam(':surname', $_POST['surname']);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':patronymic', $_POST['patronymic']);
    $stmt->bindParam(':login', $_POST['login']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':phone', $_POST['phone']);
    $stmt->bindParam(':password', $_POST['password']);

    if ($stmt->execute()) {
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['role'] = "Пользователь";
        header("Location: /profile/");
        exit;
    } else {
        echo "Ошибка добавления данных";
    }
}

