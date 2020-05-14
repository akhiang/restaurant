<?php
    require_once "../conn.php";

    $id = $_POST['id'];
    $user_id = $_POST['user_id'];

    $q = $conn->query("DELETE FROM tb_cart_detail WHERE id = '$id' AND user_id = '$user_id'");
    
?>