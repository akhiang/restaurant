<?php
    require_once "../conn.php";

    $cart_id = $_POST['cart_id'];
    // var_dump($menu_id);
    $user_id = $_POST['user_id'];
    $qty = $_POST['qty'];

    $oldQty = $conn->query("SELECT menu_id, qty FROM tb_cart_detail WHERE id = '$cart_id' AND user_id = '$user_id'")->fetch_assoc();
    
    // print_r($oldQty);
    // var_dump($qty);

    if ($qty > $oldQty['qty']) {
        // echo '+';
        // echo $oldQty[''];
        $selisih = $qty - $oldQty['qty'];
        $q = $conn->query("SELECT ingredient_id, use_qty FROM tb_menu_ingredient WHERE menu_id = $oldQty[menu_id]");
        if ($q->num_rows > 0) {
            foreach ($q as $key => $row) {
                $menu_ing_id = $row['ingredient_id'];
                $q = $conn->query("SELECT id, name, qty FROM tb_bahan WHERE id = '$menu_ing_id'");
                if ($q->num_rows > 0) {
                    $ingre = $q->fetch_assoc(); 
                    
                    if ($ingre['qty'] < ($row['use_qty'] * $selisih )) {
                        $ingreStock[] = false;
                    } else {     
                        $ingreStock[] = true;
                    }
                }
            }
            // var_dump($ingreStock);
            if (in_array(false, $ingreStock)) {
                $status = 'quantity';
                // echo 'stock tdk ckup';
            } else {
                $q2 = $conn->query("SELECT ingredient_id, use_qty FROM tb_menu_ingredient WHERE menu_id = $oldQty[menu_id]");
                if ($q2->num_rows > 0) {
                    foreach ($q2 as $key => $value) {
                        // var_dump($value);
                        $menu_ing_id = $value['ingredient_id'];
                        // var_dump($menu_ing_id);
                        $q3 = $conn->query("SELECT id, name, qty FROM tb_bahan WHERE id = '$menu_ing_id'");
                        if ($q3->num_rows > 0) {
                            $ingre = $q3->fetch_assoc();

                            $stock = $ingre['qty'] - ($value['use_qty'] * $selisih);
                            // var_dump($stock);
                            $conn->query("UPDATE tb_bahan SET qty = $stock WHERE id = '$menu_ing_id'");
                            $insert_menu = true;
                        }
                    }
                }

                if ($insert_menu) {
                    $sameItem = $conn->query("SELECT * FROM tb_cart_detail WHERE user_id = '$user_id' AND menu_id = $oldQty[menu_id]");

                    if ($sameItem->num_rows > 0) {       
                        $sql = "UPDATE tb_cart_detail SET qty = qty + $selisih WHERE user_id = '$user_id' AND menu_id = $oldQty[menu_id]";
                    }
                    $conn->query($sql);
                    $status = 'success';
                }
            }
        }
    } else if ($qty < $oldQty['qty']) {
        // echo '-';
        // echo $selisih;
        $selisih = $oldQty['qty'] - $qty;
        $menu = $conn->query("SELECT * FROM tb_cart_detail WHERE id = '$cart_id' AND user_id = '$user_id'")->fetch_assoc();
        // var_dump($menu);
        $q4 = $conn->query("SELECT ingredient_id, use_qty FROM tb_menu_ingredient WHERE menu_id = '$menu[menu_id]'");
        if ($q4->num_rows > 0) {
            foreach ($q4 as $key => $row) {
                // var_dump($row);
                $menu_ing_id = $row['ingredient_id'];
                $use_qty = $row['use_qty'];
               // var_dump($menu_ing_id);
                $q5 = $conn->query("SELECT qty FROM tb_bahan WHERE id = '$menu_ing_id'");
                $ingre = $q5->fetch_assoc();
                // var_dump($ingre);
                $return_qty = $ingre['qty'] + ($use_qty * $selisih);
                // var_dump($return_qty);
                $conn->query("UPDATE tb_bahan SET qty = '$return_qty' WHERE id = '$menu_ing_id'");
                $update_qty = true;
            }
            if ($update_qty) {
                $q = $conn->query("UPDATE tb_cart_detail SET qty = '$qty' WHERE id = '$cart_id' AND user_id = '$user_id'");
                $status = 'success';
            }
        } 
    }
    echo $status;
?>