<?php
    require_once "../conn.php";

    $ing_id = $_POST['ingredient_id'];
    $menu_id = $_POST['menu_id'];
    $use_qty = $_POST['use_qty'];

    $sql = "INSERT INTO tb_menu_ingredient (id, menu_id, ingredient_id, use_qty) VALUES
            ('','$menu_id', '$ing_id', '$use_qty')";

    $q = $conn->query($sql);
?>