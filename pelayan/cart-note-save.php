<?php
    require_once "../conn.php";

    $cartId = $_POST['id'];
    $note = $_POST['note'];

    $q = $conn->query("UPDATE tb_cart_detail SET note = '$note' WHERE id = '$cartId'");
?>