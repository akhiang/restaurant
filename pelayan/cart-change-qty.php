<?php
    require_once "../conn.php";

    $menu_id = $_POST['menu_id'];
    $user_id = $_POST['user_id'];
    $qty = $_POST['qty'];

    $oldQty = $conn->query("SELECT qty FROM tb_cart_detail WHERE id = '$menu_id' AND user_id = '$user_id'")->fetch_assoc();
    
    // print_r($oldQty);
    // var_dump($qty);

    if ($qty > $oldQty['qty']) {
        // echo '+';
        // echo $selisih;
        $selisih = $qty - $oldQty['qty'];
        $q = $conn->query("SELECT ingredient_id, use_qty FROM tb_menu_ingredient WHERE menu_id = '$menu_id'");
        foreach ($q as $key => $value) {
            # code...
            var_dump($value);
        }
        // if ($q->num_rows > 0) {
        //     echo 'ada';
        // } else {
        //     echo 'no';
        // }
    }
        
    // } else if ($qty < $oldQty['qty']) {
    //     // echo '-';
    //     // echo $selisih;
    //     $selisih = $oldQty['qty'] - $qty;
    

    // $q = $conn->query("UPDATE tb_cart_detail SET qty = '$qty' WHERE id = '$menu_id' AND user_id = '$user_id'");
?>