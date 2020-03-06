<?php
    require_once "../conn.php";

    $menu_id = $_POST['id'];
    $order_number = $_POST['num'];
    $subtotal = 0;

    $q = $conn->query("SELECT menu_id, qty FROM tb_order_detail WHERE menu_id = '$menu_id' AND order_number = '$order_number'");
    $menu = $q->fetch_assoc();

    $q = $conn->query("SELECT ingredient_id, use_qty FROM tb_menu_ingredient WHERE menu_id = '$menu[menu_id]'");
    
    if ($q->num_rows > 0) {
        foreach ($q as $key => $row) {
            // var_dump($row);
            $menu_ing_id = $row['ingredient_id'];
            $use_qty = $row['use_qty'];
            
            $q3 = $conn->query("SELECT qty FROM tb_bahan WHERE id = '$menu_ing_id'");
            $ingre = $q3->fetch_assoc();
            // var_dump($ingre);
            
            // var_dump($return_qty);
            $return_qty = $ingre['qty'] + $use_qty;
            $conn->query("UPDATE tb_bahan SET qty = '$return_qty' WHERE id = '$menu_ing_id'");
        }
    }

    $qty = $menu['qty'];
    if($qty > 1){
        $qty--;
        $sql = "UPDATE tb_order_detail SET qty = '$qty' WHERE menu_id = '$menu_id' AND order_number = '$order_number'";
        $q = $conn->query($sql);
    } else {
        $sql = "DELETE FROM tb_order_detail WHERE menu_id = '$menu_id' AND order_number = '$order_number'";
        $q = $conn->query($sql);
    }

    // update total di tb_order
    $sql = "SELECT * FROM tb_order_detail WHERE order_number = '$order_number'";
    $q = $conn->query($sql);
    while ($row = $q->fetch_assoc()) {
            // $harga = number_format($row['harga'], 0, ',', '.');
            $amount = $row['price'] * $row['qty'];
            $subtotal += $amount;
        }
    $tax = $subtotal * 0.1;
    $total = $subtotal + $tax;
    
    $sql = "UPDATE tb_order SET subtotal = '$subtotal',
            tax = '$tax', total = '$total'
            WHERE order_number = '$order_number'";
    $q = $conn->query($sql);
?>