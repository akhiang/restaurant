<?php
    require_once "../conn.php";

    $order_number = $_POST['num'];
    $menu_id = $_POST['hidden_id_menu'];
    $nama = $_POST['hidden_nama_menu'];
    $harga = $_POST['hidden_harga'];
    $insert_menu = false;
    $subtotal = 0;

    $q = $conn->query("SELECT ingredient_id, use_qty FROM tb_menu_ingredient WHERE menu_id = '$menu_id'");

    $checkIngre = $q->num_rows;
    if ($checkIngre > 0) {
        foreach ($q as $row) {
            $menu_ing_id = $row['ingredient_id'];
            // var_dump($menu_ing_id);
            $q = $conn->query("SELECT id, name, qty FROM tb_bahan WHERE id = '$menu_ing_id'");
            if ($q->num_rows > 0) {
                $ingre = $q->fetch_assoc();
                if ($ingre['qty'] < $row['use_qty']) {
                    // var_dump($ingre['name']. 'jumlah' .$ingre['qty']);
                    $status = 'quantity';
                    $insert_menu = false;
                    break;
                } else {
                    $curr = $ingre['qty'] - $row['use_qty'];
                    $conn->query("UPDATE tb_bahan SET qty = $curr WHERE id = '$menu_ing_id'");
                    $insert_menu = true;
                    // var_dump($ingre['name']. 'sisa' .$curr);
                }
                // var_dump($insert_menu);
            }         
        }
        if ($insert_menu) {
            $sameItem = $conn->query("SELECT * FROM tb_order_detail WHERE order_number = '$order_number' AND menu_id = '$menu_id'");

            if ($sameItem->num_rows > 0) {       
                $sql = "UPDATE tb_order_detail SET qty = qty + 1 WHERE order_number = '$order_number' AND menu_id = '$menu_id'";
            } else {
                $sql = "INSERT INTO tb_order_detail (order_number, menu_id, menu_name, qty, price, id) VALUES
                    ('$order_number', '$menu_id', '$nama', 1, '$harga', '')";
            }
            // var_dump('insert');
            $conn->query($sql);

            // update total di tb_order
            $sql2 = "SELECT * FROM tb_order_detail WHERE order_number = '$order_number'";
            $q2 = $conn->query($sql2);
            while ($od = $q2->fetch_assoc()) {
                    // $harga = number_format($row['harga'], 0, ',', '.');
                    $amount = $od['price'] * $od['qty'];
                    $subtotal += $amount;
                }
            $tax = $subtotal * 0.1;
            $total = $subtotal + $tax;
            
            $conn->query("UPDATE tb_order SET subtotal = '$subtotal', tax = '$tax', total = '$total' WHERE order_number = '$order_number'");

            $status = 'success';
        } else {
            //
        }
        
    } else {
        $status = 'ingredient';
    }
    echo $status;
?>