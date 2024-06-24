<?php
session_start();
if (isset($_SESSION['login'])) {
    header("Location: /profile/");
    exit;
}

?>

<head>
    <title>Регистрация в Step In Poizon</title>
    <link rel="icon" type="image/svg+xml" href="../photo/iconca.ico">
    <link rel="stylesheet" href="../css/vhod-reg.css">
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
        <div class="navigation">
            <?php
            include "../inc/navigate.php";
            ?>
        </div>
        <div class="fr">
            <div class="krai-left"></div>
            <div class="main">
                
                <section>
                    <div>
                        <?php
                        if (isset($_GET['message'])) {
                            echo "<div class='warn'>
                    {$_GET['message']}
                    </div>";
                        }
                        ?>

                    </div>
                </section>
                <form action="/admin/controllers/registration.php" method="post" class="form-vvod">

                    <div class="otstup">
                        <label for="surname" class="textt">Фамилия</label>
                        <input type="text" class="pole" id="surname" name="surname" required>
                    </div>
                    <div class="otstup">
                        <label for="name" class="textt">Имя</label>
                        <input type="text" class="pole" id="name" name="name" required>
                    </div>
                    <div class="otstup">
                        <label for="patronymic" class="textt">Отчество</label>
                        <input type="text" class="pole" id="patronymic" name="patronymic" required>
                    </div>
                    <div class="otstup">
                        <label for="login" class="textt">Логин</label>
                        <input type="text" class="pole" id="login" name="login" required>
                    </div>
                    <div class="otstup">
                        <label for="email" class="textt">Адрес электронной почты</label>
                        <input type="email" class="pole" id="email" name="email" required>
                    </div>
                    <div class="otstup">
                        <label for="phone" class="textt">Телефон</label>
                        <input type="tel" class="pole" id="phone" name="phone" minlength="11" maxlength="11" pattern="/+?[0-9/(/)/-]+" placeholder="+7(XXX)-XXX-XX-XX" required>
                    </div>
                    <div class="otstup">
                        <label for="password" class="textt">Пароль</label>
                        <input type="password" class="pole" id="password" name="password" minlength="6" required>
                    </div>
                    <div class="otstup">
                        <label for="password-repeat" class="textt">Повторите
                            пароль</label>
                        <input type="password" class="pole" id="password-repeat" name="password-repeat" minlength="6" required>
                    </div>
                    <input type="submit" class="knopka" value="Зарегистрироваться">
                    <a href="../vhod/" class="knopka">Уже есть аккаунт?</a>
                </form>
            </div>

        </div>
        <div class="krai-right"></div>
    </div>

</body>