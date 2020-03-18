<?php
	require_once "../conn.php";

    $id = $_POST['id'];
    $menu_id = $_POST['menu_id'];
    $ing_id = $_POST['ingredient_id'];
    $use_qty = $_POST['use_qty'];

	$sql = "UPDATE tb_menu_ingredient SET menu_id = '$menu_id', 
            ingredient_id = '$ing_id', use_qty = '$use_qty' WHERE id = '$id'";
    $conn->query($sql);
?>
