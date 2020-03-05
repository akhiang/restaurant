<?php
    require_once "../conn.php";

    $user_id = $_POST['id'];
    
    $menus = $conn->query("SELECT * FROM tb_cart_detail WHERE user_id = '$user_id'");
    foreach ($menus as $key => $menu) {
        // var_dump($menu['menu_id']);
        // var_dump($menu['menu_name']);
        // var_dump($menu['qty']);
        $menu_ingredients = $conn->query("SELECT ingredient_id, use_qty FROM tb_menu_ingredient WHERE menu_id = '$menu[menu_id]'");
        foreach ($menu_ingredients as $key => $ingre) {
            // var_dump($ingre);
            $q = $conn->query("SELECT name, qty FROM tb_bahan WHERE id = '$ingre[ingredient_id]'");
            $ingredient = $q->fetch_assoc();
            $total = ($ingre['use_qty'] * $menu['qty'] );
            $balik = $ingredient['qty'] + $total;

            $conn->query("UPDATE tb_bahan SET qty = '$balik' WHERE id = '$ingre[ingredient_id]'");
            // var_dump($ingredient['name'].'='.$total);
            // var_dump('kem '.$ingredient['name'].'='.$balik);
            // foreach ($ingredients as $key => $value) {
                // var_dump($value);

            // }
        }
    }

    $sql = "DELETE FROM tb_cart_detail WHERE user_id = '$user_id'";
    $conn->query($sql);
?>