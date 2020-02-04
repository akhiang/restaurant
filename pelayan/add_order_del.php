<?php
    require_once "../conn.php";

    $id = $_POST['id'];
    $order_number = $_POST['num'];
    $sql = "SELECT qty FROM tb_order_detail_temp WHERE kode_menu = '$id' AND order_number = '$order_number'";
    $q = $conn->query($sql);
    $row = $q->fetch_assoc();
    $qty = $row['qty'];
    if($qty > 1){
        $qty--;
        $sql = "UPDATE tb_order_detail_temp SET qty = '$qty' WHERE kode_menu = '$id' AND order_number = '$order_number'";
        $q = $conn->query($sql);
    } else {
        $sql = "DELETE FROM tb_order_detail_temp WHERE kode_menu = '$id' AND order_number = '$order_number'";
        $q = $conn->query($sql);
    }
?>