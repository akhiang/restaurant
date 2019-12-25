<?php
    require_once "../conn.php";

    $id = $_POST['id'];

    $sql = "SELECT qty FROM tb_cart_detail WHERE kode_menu = '$id'";
    $q = $conn->query($sql);
    $row = $q->fetch_assoc();

    $qty = $row['qty'];
    if($qty > 1){
        $qty--;
        $sql = "UPDATE tb_cart_detail SET qty = '$qty' WHERE kode_menu = '$id'";
        $q = $conn->query($sql);
    } else {
        $sql = "DELETE FROM tb_cart_detail WHERE kode_menu = '$id'";
        $q = $conn->query($sql);
    }
?>