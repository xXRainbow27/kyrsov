<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: /auth/");
    exit;

}
include "inc/header.php";
?>

<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='/style/main.css'>
</head>

<body>
    <div class='header'>
        <div class='container'>
            <div class='header-down'>

                <div class='header-title'>


                    <div class='header-subtitle'>
                        Добро пожаловать!
                    </div>            
                </div>
            </div>
        </div>
    </div>
</body>