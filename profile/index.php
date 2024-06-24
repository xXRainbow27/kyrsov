<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: /registration/");
    exit;
}
include "../function/funct.php";
?>


<head>
    <title>Step in Poizon</title>
    <link rel="icon" type="image/svg+xml" href="../photo/iconca.ico">
    <link rel="stylesheet" href="../css/prof.css">
</head>

<body>
    <div class="container">

        <div class="top">
            <div class="left">

            </div>
            <a href="../index.php" class="top-main"> </a>
            <div class="right">

            </div>
        </div>
        <div class="navigation ">
            <?php

            include "../inc/navigate.php";
            ?>
        </div>
        <div class="main">
            <div class="info">
                <?php echo fnGetProfile($_SESSION['login'], $pdo); ?>
                <a class="label" href="/admin/controllers/logout.php">Отключиться от аккаунта</a>
            </div>

        </div>

    </div>
    </div>
</body>