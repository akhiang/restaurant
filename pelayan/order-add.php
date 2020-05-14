<?php
    require_once "../conn.php";

    $ingreStock = [];
    
    if (!empty($_POST)) {
        $user_id = $_POST['hidden_user_id'];
        $menu_id = $_POST['hidden_id'];
        $name = $_POST['hidden_name'];
        $qty = $_POST['hidden_qty'];
        $price = $_POST['hidden_price'];
        
        $q = $conn->query("SELECT ingredient_id, use_qty FROM tb_menu_ingredient WHERE menu_id = '$menu_id'");
        if ($q->num_rows > 0) {
            foreach ($q as $key => $row) {
                $menu_ing_id = $row['ingredient_id'];
                $q = $conn->query("SELECT id, name, qty FROM tb_bahan WHERE id = '$menu_ing_id'");
                if ($q->num_rows > 0) {
                    $ingre = $q->fetch_assoc(); 
                    
                    if ($ingre['qty'] < ($row['use_qty'] * $qty )) {
                        $ingreStock[] = false;
                    } else {     
                        $ingreStock[] = true;
                    }
                }
            }
            // var_dump($ingreStock);
            if (in_array(false, $ingreStock)) {
                $status = 'quantity';
            } else {
                $q2 = $conn->query("SELECT ingredient_id, use_qty FROM tb_menu_ingredient WHERE menu_id = '$menu_id'");
                if ($q2->num_rows > 0) {
                    foreach ($q2 as $key => $value) {
                        $menu_ing_id = $value['ingredient_id'];
                        // var_dump($menu_ing_id);
                        $q3 = $conn->query("SELECT id, name, qty FROM tb_bahan WHERE id = '$menu_ing_id'");
                        if ($q3->num_rows > 0) {
                            $ingre = $q3->fetch_assoc();

                            $stock = $ingre['qty'] - ($value['use_qty'] * $qty);                        
                            $conn->query("UPDATE tb_bahan SET qty = $stock WHERE id = '$menu_ing_id'");
                            $insert_menu = true;
                        }
                    }
                }

                if ($insert_menu) {
                    $sameItem = $conn->query("SELECT * FROM tb_cart_detail WHERE user_id = '$user_id' AND menu_id = '$menu_id'");

                    if ($sameItem->num_rows > 0) {       
                        $sql = "UPDATE tb_cart_detail SET qty = qty + $qty WHERE user_id = '$user_id' AND menu_id = '$menu_id'";
                    } else {
                        $sql = "INSERT INTO tb_cart_detail (user_id, menu_id, menu_name, qty, price, id) VALUES
                            ('$user_id', '$menu_id', '$name', $qty, '$price', '')";
                    }
                    $conn->query($sql);
                    $status = 'success';
                }
            }            
        } else {
            $status = 'ingredient';
        }
    }
    echo $status;
?>