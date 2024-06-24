<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: /auth/");
    exit;
}
include "../function/funct.php";
include "../function/connect.php";

?>

<head>
    <title>Step In Poizon</title>
    <link rel="icon" type="image/svg+xml" href="../photo/iconca.ico">
    <link rel="stylesheet" href="../CSS/adm.css">
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
        <div class="MA">
            <div class="panelka">
                <div class="tablica">
                    <?php
                    try {
                        $sql = "SELECT * FROM tovar";
                        $result = $pdo->query($sql);
                        echo "<table ><tr><th>ID</th><th>Название</th><th>Цена</th><th>Изображение</th><th></th></tr>";
                        foreach ($result as $row) {
                            echo "<tr>";
                            echo "<td>" . $row["idtovar"] . "</td>";
                            echo "<td>" . $row["nazvanie"] . "</td>";
                            echo "<td>" . $row["cena"] . "</td>";
                            echo "<td>" . $row["image"] . "</td>";
                            echo "<td><a class=tab-a href='update.php?idtovar=" . $row["idtovar"] . "'>Обновить</a></td>";
                            echo "<td><form action='../admin/controllers/delete.php' method='post'>
                        <input type='hidden' name='idtovar' value='" . $row["idtovar"] . "' />
                        <input type='submit' class=btn-del value='Удалить'>
                    </form></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } catch (PDOException $e) {
                        echo "Database error: " . $e->getMessage();
                    }

                    ?>
                </div>
                <div class="dop">
                    <a href="dobav.php" class="dopav">Добавить Карточку Товара</a>

                </div>


            </div>
        </div>

    </div>

</body>