<?php
$mainBtn = "";
$cart = "";
$lk = "";
if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] == "Администратор") {
        $mainBtn .= '<a class="Avt-Izb" href="/admin/"><img src="../photo/adm.png"></a>';
    }
    $lk .= '<a href="/profile/index.php" ><img src="../photo/lk.png"></a>';
    $cart .=  '<a href="/cart/index.php"  ><img src="../photo/korzina.png"></a>';
} else {
    $mainBtn = '<a href="..\vhod\index.php"  ><img src="../photo/avtoriz.png"></a>';
}
?>

<div class="edge">
</div>
<div class="slogan">
    <h1>Откройте мир китайской моды и стиля с интернет-магазином одежды и обуви из Китая с сервисом Poizon. Качество, стиль и доступные цены ждут вас!</h1>
</div>
<div class="function">
    <?= $mainBtn ?>
    <?= $cart ?>
    <?= $lk ?>
</div>