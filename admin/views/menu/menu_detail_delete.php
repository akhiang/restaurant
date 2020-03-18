<?php
    require_once "../conn.php";
    $id = $_POST['id'];
    
	$sql = "DELETE FROM tb_menu_ingredient WHERE id = '$id'";
    $conn->query($sql);
?>