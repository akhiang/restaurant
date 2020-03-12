<?php
    require_once "../conn.php";

    $order_number = $_POST['num'];
    
    $menus = $conn->query("SELECT * FROM tb_order_detail WHERE order_number = '$order_number'");
    $checkMenus = $menus->num_rows;

    if($checkMenus > 0) {
        foreach ($menus as $key => $menu) {
            $menu_ingredients = $conn->query("SELECT ingredient_id, use_qty FROM tb_menu_ingredient WHERE menu_id = '$menu[menu_id]'");
            foreach ($menu_ingredients as $key => $ingre) {
                // var_dump($ingre);
                $q = $conn->query("SELECT name, qty FROM tb_bahan WHERE id = '$ingre[ingredient_id]'");
                $ingredient = $q->fetch_assoc();
                $use_total = ($ingre['use_qty'] * $menu['qty'] );
                $return = $ingredient['qty'] + $use_total;

                $conn->query("UPDATE tb_bahan SET qty = '$return' WHERE id = '$ingre[ingredient_id]'");
            }
        }
    }

    $sql = "DELETE FROM tb_order_detail WHERE order_number = '$order_number'";
    $conn->query($sql);
?>