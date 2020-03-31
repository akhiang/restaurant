<?php
    require_once "../conn.php";

    $table_id = $_POST['table'];
    $user_id = $_POST['user'];
    
    $menus = $conn->query("SELECT * FROM tb_cart_detail WHERE user_id = '$user_id'");
    $checkMenus = $menus->num_rows;
    
    if($checkMenus > 0) {
        foreach ($menus as $key => $menu) {
            $menu_ingredients = $conn->query("SELECT ingredient_id, use_qty FROM tb_menu_ingredient WHERE menu_id = '$menu[menu_id]'");
            foreach ($menu_ingredients as $key => $ingre) {
                $q = $conn->query("SELECT name, qty FROM tb_bahan WHERE id = '$ingre[ingredient_id]'");
                $ingredient = $q->fetch_assoc();
                $total = ($ingre['use_qty'] * $menu['qty'] );
                $balik = $ingredient['qty'] + $total;

                $conn->query("UPDATE tb_bahan SET qty = '$balik' WHERE id = '$ingre[ingredient_id]'");
            }
        }        
        $sql = "DELETE FROM tb_cart_detail WHERE user_id = '$user_id'";
        $conn->query($sql);
    }
    updateTable($table_id);
?>