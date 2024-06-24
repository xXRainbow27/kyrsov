<?php
include "../function/funct.php";
include "../function/connect.php";

?>
<?php
session_start();

$user_login = $_SESSION['login'];

if (!isset($user_login)) {
    header('location: /registration/ ');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM cart WHERE id = :delete_id");
    $stmt->bindParam(':delete_id', $delete_id);
    $stmt->execute();
    header('location:index.php');
}

if (isset($_GET['delete_all'])) {
    $stmt = $pdo->prepare("DELETE FROM cart WHERE user_login = :user_login");
    $stmt->bindParam(':user_login', $user_login);
    $stmt->execute();
    header('location:index.php');
}

if (isset($_POST['update_quantity'])) {
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    $stmt = $pdo->prepare("UPDATE cart SET quantity = :cart_quantity WHERE id = :cart_id");
    $stmt->bindParam(':cart_quantity', $cart_quantity);
    $stmt->bindParam(':cart_id', $cart_id);
    $stmt->execute();
    $message[] = 'количество товаров в корзине обновлено!';
}
?>

<head>
    <title>Step In Poizon</title>
    <link rel="icon" type="image/svg+xml" href="../photo/iconca.ico">
    <link rel="stylesheet" href="../CSS/cart.css">
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
    </div>
    <section class="cart">

        <h1 class="title">Добавленные продукты</h1>

        <div class="box-cont">
            <?php
            $grand_total = 0;
            $select_cart = $pdo->prepare("SELECT * FROM cart  WHERE user_login = :user_login");
            $select_cart->bindParam(':user_login', $user_login);
            $select_cart->execute();

            if ($select_cart->rowCount() > 0) {
                while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="box">

                        <img src="<?php echo $fetch_cart['image']; ?>" class="image">
                        <div class="name"><?php echo $fetch_cart['nazvanie']; ?></div>
                        <form action="" method="post">
                            <input type="hidden" value="<?php echo $fetch_cart['id']; ?>" name="cart_id">
                            <input type="number" min="1" value="<?php echo $fetch_cart['quantity']; ?>" name="cart_quantity" class="inp-quantity">
                            <input type="submit" value="Изменить" class="option-btn" name="update_quantity">
                        </form>
                        <div class="subTotal"> Сумма :
                            <span><?php echo $sub_total = mult($fetch_cart['cena'], $fetch_cart['quantity']); ?>Рублей</span>
                        </div>
                        <a href="index.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('удалить из корзины?');">Удалить</a>
                    </div>
            <?php
                    $grand_total += $sub_total;
                }
            } else {
                echo '<p class="empty">Корзина пуста</p>';
            }
            ?>
        </div>
        <div class="morebtn">
            <a href="index.php?delete_all" class="deletebtn <?php echo ($grand_total > 1) ? '' : 'disabled' ?>" onclick="return confirm('Удалить все из корзины?');">Очистить корзину</a>
            <p>Общая сумма : <span><?php echo $grand_total; ?>Рублей</span></p>
        </div>
    </section>
</body>