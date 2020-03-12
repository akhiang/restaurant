<?php
    require_once "../conn.php";

    $user_id = $_POST['id'];
    $conn->query("DELETE FROM tb_cart_detail WHERE user_id = '$user_id'");
?>