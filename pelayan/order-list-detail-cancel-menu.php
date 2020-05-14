<?php
    require_once "../conn.php";

    $id = $_POST['id'];
    $orderNumber = $_POST['orderNumber'];    
    $subtotal = 0; 

    $menu = $conn->query("SELECT * FROM tb_order_detail WHERE id = '$id' AND order_number = '$orderNumber'")->fetch_assoc();
    $q2 = $conn->query("SELECT ingredient_id, use_qty FROM tb_menu_ingredient WHERE menu_id = '$menu[menu_id]'");
    if ($q2->num_rows > 0) {
        foreach ($q2 as $key => $row) {
            // var_dump($row);
            $menu_ing_id = $row['ingredient_id'];
            $use_qty = $row['use_qty'];
            // var_dump($menu_ing_id);
            $q3 = $conn->query("SELECT qty FROM tb_bahan WHERE id = '$menu_ing_id'");
            $ingre = $q3->fetch_assoc();
            // var_dump($ingre);
            $return_qty = $ingre['qty'] + ($use_qty * $menu['qty']);
            // var_dump($return_qty);
            $conn->query("UPDATE tb_bahan SET qty = '$return_qty' WHERE id = '$menu_ing_id'");
        }
    } 

    $conn->query("UPDATE tb_order_detail SET cancel = 1 WHERE id = '$id'");

    $sql = "SELECT * FROM tb_order_detail WHERE order_number = '$orderNumber' AND cancel = 0";
    $q = mysqli_query($conn,$sql);
    $result = mysqli_num_rows($q);

    if ($result > 0) {
        while ($value = mysqli_fetch_assoc($q)) {
            $menuId = $value['menu_id'];
            $id = $value['id'];
            $amount = $value['price'] * $value['qty'];
            $subtotal += $amount;
        }
        $tax = $subtotal * 0.1;
        $total = $subtotal + $tax;
        $conn->query("UPDATE tb_order SET subtotal = '$subtotal', tax = '$tax', total = '$total' WHERE order_number = '$orderNumber'");
    }    
?>