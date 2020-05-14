<?php
    $conn = mysqli_connect("localhost", "root", "", "restaurant");
    if(!$conn) {
        die("Connecttion failed: ".mysqli_connect_error());
    }

    function updateTable($table_id){
        global $conn;
        if($table_id !== ''){
        // echo 'tidak kosong';
            $q = $conn->query("UPDATE tb_meja set status = 1 WHERE kode_meja = $table_id");
        }  
    }

    function orderStatus($status){
        if($status == 'unpaid'){
            return '<span class="badge badge-warning">Unpaid</span>';
        } else if($status == 'paid') {
            return '<span class="badge badge-success">Paid</span>';
        } else {
            return '<span class="badge badge-secondary">Cancelled</span>';
        }
    }

    function updateOrderTotal(){
        // update total di tb_order
        global $conn;
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
    }

    function getMenuStock($menuId) {
        global $conn;
        $q = $conn->query("SELECT ingredient_id, use_qty FROM tb_menu_ingredient WHERE menu_id = '$menuId'");

        $bahan = [];

        $checkIngre = $q->num_rows;
        if ($checkIngre > 0) {
            foreach ($q as $row) {
                $menu_ing_id = $row['ingredient_id'];
                $q = $conn->query("SELECT id, name, qty FROM tb_bahan WHERE id = '$menu_ing_id'");
                $bahan[] = $row;
                // if ($q->num_rows > 0) {
                //     $ingre = $q->fetch_assoc();
                //     // var_dump($row);
                //     // return $ingre['name'];
                //     // if ($ingre['qty'] < $row['use_qty']) {

                //         // var_dump($ingre['name']. 'jumlah' .$ingre['qty']);
                //     //     $status = 'quantity';
                //     //     $insert_menu = false;
                //     //     break;
                //     // } else {
                //     //     $curr = $ingre['qty'] - $row['use_qty'];
                //     //     $conn->query("UPDATE tb_bahan SET qty = $curr WHERE id = '$menu_ing_id'");
                //     //     $insert_menu = true;
                //     //     // var_dump($ingre['name']. 'sisa' .$curr);
                // }
                    // var_dump($insert_menu);
            }
            // usort($bahan, function($a, $b) {
            //     if ($a["use_qty"] == $b["use_qty"])
            //         return (0);
            //     return (($a["use_qty"] < $b["use_qty"]) ? 1 : -1);
            // });
            // print_r($bahan[0][]);

            // $conn->query("SELECT qty FROM tb_bahan WHERE id = ''");

        }
        //     if ($insert_menu) {
        //         $sameItem = $conn->query("SELECT * FROM tb_cart_detail WHERE user_id = '$user_id' AND menu_id = '$menu_id'");

        //         if ($sameItem->num_rows > 0) {       
        //             $sql = "UPDATE tb_cart_detail SET qty = qty + 1 WHERE user_id = '$user_id' AND menu_id = '$menu_id'";
        //         } else {
        //             $sql = "INSERT INTO tb_cart_detail (user_id, menu_id, menu_name, qty, price, id) VALUES
        //                 ('$user_id', '$menu_id', '$nama', 1, '$harga', '')";
        //         }
        //         // var_dump('insert');
        //         $conn->query($sql);
        //         $status = 'success';
        //     } else {
        //         //
        //     }
            
        // } else {
        //     $status = 'ingredient';
        // }
    }
?>