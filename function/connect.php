<?php
    $host = 'web.edu';  
    $user = '21289';    
    $pass = 'nyszch'; 
    $db_name = '21289_kursovv';   
  
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Ошибка подключения к базе данных: " . $e->getMessage());
    }
?>

