<?php
    require_once "../conn.php";

    $user_id = $_POST['hidden_user_id'];
    $menu_id = $_POST['hidden_id_menu'];
    $nama = $_POST['hidden_nama_menu'];
    $harga = $_POST['hidden_harga'];
    
    // var_dump($user_id);
    $i = 0;
    $insert_menu = false;
    // $q = $conn->query("SELECT id FROM tbl_menu WHERE id = '$menu_id'");
    // $menu_id = $q->fetch_assoc();
    
    $q = $conn->query("SELECT ingredient_id, use_qty FROM tb_menu_ingredient WHERE menu_id = '$menu_id'");

    $checkIngre = $q->num_rows;
    if ($checkIngre > 0) {
        foreach ($q as $row) {
            $menu_ing_id = $row['ingredient_id'];
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
            $sameItem = $conn->query("SELECT * FROM tb_cart_detail WHERE user_id = '$user_id' AND menu_id = '$menu_id'");

            if ($sameItem->num_rows > 0) {       
                $sql = "UPDATE tb_cart_detail SET qty = qty + 1 WHERE user_id = '$user_id' AND menu_id = '$menu_id'";
            } else {
                $sql = "INSERT INTO tb_cart_detail (user_id, menu_id, menu_name, qty, price, id) VALUES
                    ('$user_id', '$menu_id', '$nama', 1, '$harga', '')";
            }
            // var_dump('insert');
            $conn->query($sql);
            $status = 'success';
        } else {
            //
        }
        
    } else {
        $status = 'ingredient';
    }

    echo $status;
?>