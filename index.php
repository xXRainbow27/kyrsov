<?php
session_start();
if (isset($_SESSION['login'])) {
    $user_login = $_SESSION['login'];
}
?>
<?php
include "./admin/controllers/add_to_cart.php";
include "./function/connect.php";

$result = $pdo->query("SELECT * FROM tovar ");

?>
<?php

$btncart ="";
if (isset($_SESSION['login'])){
    $btncart .= '<input type="submit" value="Добавить в корзину" name="add_to_cart" class="card__add">';
} 
else{
    $btncart .= '<a href="/registration/"><input type="button"  value="Добавить в корзину" class="card__add"></a> ';
}
?>
<head>
    <title>Step In Poizon</title>
    <link rel="icon" type="image/svg+xml" href="../photo/iconca.ico">
    <link rel="stylesheet" href="./CSS/main.css">
</head>

<body>
    <div class="container">
        <div class="top">
            <div class="left">
            </div>
            <a href="index.php" class="top-main"> </a>
            <div class="right">
            </div>
        </div>
        <div class="navigation ">
            <?php
            include "./inc/navigate.php";
            ?>
        </div>
        <div class="main">
            <?php if (isset($message) && in_array($id_tovar_id, $message)) {
                echo '<p class="already-in-cart">Товар ранее добавлен в корзину</p>';
            } ?>
            <?php
            while ($tov = $result->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <form method="post">
                    <div class="card botom">
                        <div class="card__top">
                            <img src="<?php echo $tov['image'] ?>" class="card__image" />
                        </div>
                        <div class="card__bottom">
                            <div class="card__prices">
                                <div class="card__price"><?php echo $tov['cena'] ?> ₽</div>
                            </div>
                            <h1 class="card__title"> <?php echo $tov['nazvanie'] ?> </h1>
                            <input type="hidden" name="quantity" value="1" min="0">
                            <input type="hidden" name="id_tovar_id" value="<?php echo $tov['idtovar'] ?>">
                            <input type="hidden" name="nazvanie" value="<?php echo $tov['nazvanie'] ?>">
                            <input type="hidden" name="cena" value="<?php echo $tov['cena'] ?>">
                            <input type="hidden" name="image" value="<?php echo $tov['image'] ?>">
                            <?= $btncart ?>
                        </div>
                    </div>
                </form>
            <?php
            }
            ?>
        </div>
    </div>
</body>