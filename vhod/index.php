<?php
session_start();
if (isset($_SESSION['login'])) {
    header("Location: /profile/");
    exit;
}
?>

<head>
    <title>Вход в Step In Poizon</title>
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
        <div class="navigation ">
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

                <form action="/admin/controllers/login.php" method="post" class="form-vvod">
                    <div class="otstup">
                        <label for="login" class="label">Ваш логин</label>
                        <input type="text" class="vod" id="login" name="login" required>
                    </div>
                    <div class="otstup">
                        <label for="password" class="label">Ваш пароль</label>
                        <input type="password" class="vod" id="password" name="password" required>
                    </div>
                    <input type="submit" class="knopka " value="Авторизироваться">
                    <a href="../registration/" class="knopka">Зарегистрироваться</a>
                </form>
            </div>
            <div class="krai-right"></div>
        </div>


    </div>

</body>