<?php
    require_once "../conn.php";

    $menu_id = $_POST['menu_id'];
    $user_id = $_POST['user_id'];
    $qty = $_POST['qty'];

    $q = $conn->query("UPDATE tb_cart_detail SET qty = '$qty' WHERE id = '$menu_id' AND user_id = '$user_id'");
?>