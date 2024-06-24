<?php
include "connect.php";
function fnGetProfile($login, $pdo)
{
    $sql = sprintf("SELECT * FROM user WHERE login = '%s'", $login);
    
    if (!$result = $pdo->query($sql)) {
        echo "Ошибка получения данных";
    }
    
    $row = $result->fetch(PDO::FETCH_ASSOC);
    
    $data = sprintf(
        '<p><span class="label">Ваш логин:</span> %s</p>
         <p><span class="label">Фамилия:</span> %s</p>
         <p><span class="label">Имя:</span> %s</p>
         <p><span class="label">Отчество:</span> %s</p>
         <p><span class="label">Телефон:</span> %s</p>
         <p><span class="label">Почтовый адрес:</span> %s</p>',
        $row["login"],
        $row["surname"],
        $row["name"],
        $row["patronymic"],
        $row["phone"],
        $row["email"]
    );
    return $data;
}
if (!function_exists("shet")) {
    function mult($price, $quantity = 1)
    {
        if (!is_numeric($price) || !is_numeric($quantity)) {
            return 0;
        }
        return $price * $quantity;
    }
}
