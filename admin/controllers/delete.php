<?php
include "../../function/connect.php";
if(isset($_POST["idtovar"]))
{
    try {
        $sql = "DELETE FROM tovar WHERE idtovar = :userid";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":userid", $_POST["idtovar"]);
        $stmt->execute();
        header("Location: ../../admin/index.php ");
    }
    catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
