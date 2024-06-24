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
            <h3>Добавление Товара</h3>
            <form action="dobav.php" method="post">
                <p class="text">Название:
                <P><input type="text" class="pole" name="nazvanie" /></P>
                </p>
                <p class="text">Цена:
                <p><input type="text" class="pole" name="cena" /></p>
                </p>
                <p class="text">Cсылка на изображение:
                <p><input type="text" class="pole" name="image" /></p>
                </p>
                <input type="submit" class="dop" value="Добавить">
            </form>
            <?php
            if (isset($_POST["nazvanie"]) && isset($_POST["cena"]) && isset($_POST["image"])) {
                $tovarnazvanie = $pdo->quote($_POST["nazvanie"]);
                $tovarcena = $pdo->quote($_POST["cena"]);
                $tovarimage = $pdo->quote($_POST["image"]);

                $sql = "INSERT INTO tovar (nazvanie, cena, image) VALUES ($tovarnazvanie, $tovarcena, $tovarimage)";

                try {
                    $pdo->exec($sql);
                    header("Location: index.php");
                } catch (PDOException $e) {
                    echo "Ошибка: " . $e->getMessage();
                }
            }
            ?>
        </div>
    </div>
</body>