<?php
    require_once "../conn.php";

    $orderNumber = $_POST['orderNumber'];
    $conn->query("UPDATE tb_order SET order_status = 'cancelled' WHERE order_number = '$orderNumber'");

    $q = $conn->query("SELECT * FROM tb_order_detail WHERE order_number = '$orderNumber' AND cancel = 0");
    if ($q->num_rows > 0) {
        foreach ($q as $key => $menu) {
            // var_dump($menu['menu_name']);
            $menu_ingredients = $conn->query("SELECT ingredient_id, use_qty FROM tb_menu_ingredient WHERE menu_id = '$menu[menu_id]'");
            foreach ($menu_ingredients as $key => $ingre) {
                $q = $conn->query("SELECT name, qty FROM tb_bahan WHERE id = '$ingre[ingredient_id]'");
                $ingredient = $q->fetch_assoc();
                // var_dump($ingredient['name']);
                $use_total = ($ingre['use_qty'] * $menu['qty']);
                $return = $ingredient['qty'] + $use_total;
                // var_dump($return);

                $conn->query("UPDATE tb_bahan SET qty = '$return' WHERE id = '$ingre[ingredient_id]'");
            }
        }
        $sql = "UPDATE tb_order SET order_status = 'cancelled' WHERE order_number = '$orderNumber'";
        $conn->query($sql);
    }

    if (isset($_POST['tableId'])) {
        $tableId = $_POST['tableId'];
        updateTable($tableId);
    }
?>