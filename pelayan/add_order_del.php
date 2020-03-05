<?php
    require_once "../conn.php";

    $id = $_POST['id'];
    $order_number = $_POST['num'];
    $sql = "SELECT qty FROM tb_order_detail WHERE kode_menu = '$id' AND order_number = '$order_number'";
    $q = $conn->query($sql);
    $row = $q->fetch_assoc();
    $qty = $row['qty'];
    if($qty > 1){
        $qty--;
        $sql = "UPDATE tb_order_detail SET qty = '$qty' WHERE kode_menu = '$id' AND order_number = '$order_number'";
        $q = $conn->query($sql);
    } else {
        $sql = "DELETE FROM tb_order_detail WHERE kode_menu = '$id' AND order_number = '$order_number'";
        $q = $conn->query($sql);
    }

    // update total di tb_order
    $sql = "SELECT * FROM tb_order_detail WHERE order_number = '$order_number'";
    $q = $conn->query($sql);
    while ($row = $q->fetch_assoc()) {
            // $harga = number_format($row['harga'], 0, ',', '.');
            $amount = $row['harga'] * $row['qty'];
            $subtotal += $amount;
        }
    $tax = $subtotal * 0.1;
    $total = $subtotal + $tax;
    
    $sql = "UPDATE tb_order SET subtotal = '$subtotal',
            tax = '$tax', total = '$total'
            WHERE order_number = '$order_number'";
    $q = $conn->query($sql);
?>