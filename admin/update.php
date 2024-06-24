<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: /auth/");
    exit;
}
include "../function/connect.php";

?>

<head>
<title>Step In Poizon</title>
    <link rel="icon" type="image/svg+xml" href="../photo/iconca.ico">
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/obn-dobav.css">
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
        <div class="dobavlenie">
            <?php
            if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["idtovar"])) {
                $tovarid = $_GET["idtovar"];
                $sql = "SELECT * FROM tovar WHERE idtovar = :tovarid";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(":tovarid", $tovarid);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    foreach ($stmt as $row) {

                        $tovarname = $row["nazvanie"];
                        $tovarcena = $row["cena"];
                        $tovarimage = $row["image"];

                    }
                    echo "<h3>Обновление товара</h3>
                <form method='post'>
                <input type='hidden' name='idtovar' value='$tovarid' />

                    <p class=text >Название:
                    <p></p><input type='text' class=pole name='nazvanie' value='$tovarname' /></p>
                    <p class=text >Цена:
                    <p><input type='text' class=pole name='cena' value='$tovarcena' /></p></p>
                    <p class=text >Изображение:
                    <p><input type='text' class=pole name='image' value='$tovarimage' /></p></p>
                    
                    <input type='submit' class=dop value='Сохранить' />
            </form>";
                } else {
                    echo "Пользователь не найден";
                }
            } elseif (isset($_POST["idtovar"]) && isset($_POST["nazvanie"]) && isset($_POST["cena"]) && isset($_POST["image"]) ) {

                $sql = "UPDATE tovar SET nazvanie = :tovarname, cena = :tovarcena, image = :tovarimage WHERE idtovar = :tovarid";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(":tovarid", $_POST["idtovar"]);
                $stmt->bindValue(":tovarname", $_POST["nazvanie"]);
                $stmt->bindValue(":tovarcena", $_POST["cena"]);
                $stmt->bindValue(":tovarimage", $_POST["image"]);
                $stmt->execute();
                header("Location: index.php");
            } else {
                echo "Некорректные данные";
            }

            ?>

        </div>
</body>