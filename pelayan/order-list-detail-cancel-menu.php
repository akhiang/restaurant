<?php
    require_once "../conn.php";

    $id = $_POST['id'];
    $subtotal = 0; 
    $orderNumber = $_POST['orderNumber'];    
    $conn->query("UPDATE tb_order_detail SET cancel = 1 WHERE id = '$id'");

    $sql = "SELECT * FROM tb_order_detail WHERE order_number = '$orderNumber' AND cancel = 0";
    $q = mysqli_query($conn,$sql);
    $result = mysqli_num_rows($q);

    if ($result > 0) {
        while ($row = mysqli_fetch_assoc($q)) {
            $menuId = $row['menu_id'];
            $id = $row['id'];
            $amount = $row['price'] * $row['qty'];
            $subtotal += $amount;
        }
        $tax = $subtotal * 0.1;
        $total = $subtotal + $tax;
        // print_r($subtotal);
        // print_r($tax);
        // print_r($total);
        $conn->query("UPDATE tb_order SET subtotal = '$subtotal', tax = '$tax', total = '$total' WHERE order_number = '$orderNumber'");
    }
?>