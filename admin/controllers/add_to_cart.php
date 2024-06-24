<?php
include "././function/connect.php";



if (isset($_POST['add_to_cart'])) {

    $id_tovar_id = $_POST['id_tovar_id'];
    $tovar_nazvanie = $_POST['nazvanie'];
    $tovar_cena = $_POST['cena'];
    $tovar_image = $_POST['image'];
    $tovar_quantity = $_POST['quantity'] ?? 1;

    $stmt = $pdo->prepare("SELECT * FROM cart  WHERE id_tovar_id = :id_tovar_id AND user_login = :user_login");
    $stmt->bindParam(':id_tovar_id', $id_tovar_id);
    $stmt->bindParam(':user_login', $user_login);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $message[] = $id_tovar_id;
    } else {
        $insertStmt = $pdo->prepare("INSERT INTO cart(user_login, id_tovar_id, nazvanie, cena, quantity, image) 
            VALUES(:user_login, :id_tovar_id, :tovar_nazvanie, :tovar_cena, :tovar_quantity, :tovar_image)");

        $insertStmt->bindParam(':user_login', $user_login);
        $insertStmt->bindParam(':id_tovar_id', $id_tovar_id);
        $insertStmt->bindParam(':tovar_nazvanie', $tovar_nazvanie);
        $insertStmt->bindParam(':tovar_cena', $tovar_cena);
        $insertStmt->bindParam(':tovar_quantity', $tovar_quantity);
        $insertStmt->bindParam(':tovar_image', $tovar_image);
        $insertStmt->execute();
    }
}
